<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Security;
use \Model\UsersModel;

/**
 * Description of UserController
 *
 * @author Patrick
 */
class UserController extends Controller {
    // Méthodes pour le formulaire login
    public function login() {
        //Affiche le formulaire login en GET
        $this->show('user/login', array(
            'errorList' => array(),
            'email' => '',
            'successList' => array()
        ));
    }
    
    public function loginPost() {
        $errorList = array();
        $successList = array();
        
        $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        
        // Validation des données
        $formOk = true;
        if (empty($email)) {
            $errorList[] = 'Email vide<br>';
            $formOk = false;
        }
        if (strlen($password) < 8) {
            $errorList[] = 'Password de 8 caractères minimum<br>';
            $formOk = false;
        }
        if (strstr($email, '@')) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = 'Email invalide<br>';
                $formOk = false;
            }
        }

        if ($formOk) {
            // On vérifie email/password
            $auth = new AuthentificationModel();
            $userId = $auth->isValidLoginInfo($email, $password);
            // Si login ok
            if ($userId > 0) {
                // Mise en session
                $usersModel = new UsersModel();
                $userData = $usersModel->find($userId);
                $auth->logUserIn($userData);
                // Insertion dans la db dernière connexion
                $userData = $usersModel->update(array(
                    'usr_last_connected' => date('Y-m-d H:i:s')
                ), $userData['usr_id']);
                // On redirige vers la home
                $this->redirectToRoute('default_home');
            } else {
                $errorList[] = 'Email/Mot de passe non reconnus<br>';
            }
        }
        $this->show('user/login', array(
            'errorList' => $errorList,
            'successList' => $successList
        ));
    }

    public function signup() {
        // Je passe les variables à vide (initialise)
        $this->show('user/signup', array(
            'errorList' => array(),
            'pseudo' => '',
            'email' => '',
            'successList' => array()
        ));
    }

    public function signupPost() {
        $errorList = array();
        $successList = array();

        $pseudo = isset($_POST['pseudo']) ? trim(strip_tags($_POST['pseudo'])) : '';
        $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $passwordConfirm = isset($_POST['password2']) ? trim($_POST['password2']) : '';
        
        // Validation des données
        $formOk = true;
        if (empty($pseudo)) {
            $errorList[] = 'Pseudo vide<br />';
            $formOk = false;
        }
        if (empty($email)) {
            $errorList[] = 'Email vide<br />';
            $formOk = false;
        }
        if (strlen($password) < 8) {
            $errorList[] = 'Password de 8 caractères minimum<br>';
            $formOk = false;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'Email invalide<br>';
            $formOk = false;
        }
        if ($password != $passwordConfirm) {
            $errorList[] = 'Les mots de passe sont différents<br>';
            $formOk = false;
        }
        // J'appelle l'API Google-Captcha
        if ($this->googleCaptcha()) {
            $successList[] = "Captcha ok";
        } else {
            $errorList[] = "Pas de spammeurs ou de robots !";
            $this->show('user/signup', array(
                'errorList' => $errorList,
                'pseudo' => '',
                'email' => '',
                'successList' => array()
            ));
        }
        
        if ($formOk) {
            $usersModel = new UsersModel();
            // Vérifier email inexistant
            if ($usersModel->emailExists($email)) {
                $errorList[] = 'L\'email existe déjà dans la base de données<br>';
            }
            if ($usersModel->getUserByUsernameOrEmail($pseudo)) {
                $errorList[] = 'Pseudo déjà utilisé';
            } else {
                // On peut insérer
                $authentificationModel = new AuthentificationModel();
                $userData = $usersModel->insert(array(
                    'usr_pseudo' => $pseudo,
                    'usr_email' => $email,
                    'usr_password' => $authentificationModel->hashPassword($password),
                    'usr_role' => '0'
                ));
                // Si l'insertion a fonctionné
                if ($userData !== false) {
                    $auth = $authentificationModel->logUserIn($userData);
                    
                    // J'envoie un email de bienvenue
                    $subject = "Votre inscription sur WikiWebDev";
                    $welcome = "Bonjour,<br /><br />Nous sommes ravis de vous compter parmis nos membres et nous vous souhaitons de bonnes f&ecirc;tes de fin d'ann&eacute;e !<br /><br />L'&eacute;quipe WikiWebDev.";
                    $this->envoieMail($welcome, $userData['usr_email'], $subject);
                    
                    // Insertion dans la db dernière connexion
                    $userData = $usersModel->update(array(
                        'usr_last_connected' => date('Y-m-d H:i:s')
                    ), $userData['usr_id']);
                
                    // On redirige vers la home
                    $this->redirectToRoute('default_home');
                } else {
                    $errorList[] = 'erreur dans l\insertion<br>';
                }
            }
        }
        $this->show('user/signup', array(
            'errorList' => $errorList,
            'pseudo' => $pseudo,
            'email' => $email,
            'successList' => $successList
        ));
    }

    public function logout() {
        $auth = new AuthentificationModel();
        $auth->logUserOut();
        // On redirige vers la home
        $this->redirectToRoute('default_home');
    }

    public function lostpwdemail() {
        $this->show('user/lostpwdemail', array(
            'errorList' => array(),
            'email' => '',
            'successList' => array()
        ));
    }

    public function lostpwdemailPost() {
        $errorList = array();
        $successList = array();

        $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';

        $formOk = true;
        if (empty($email)) {
            $errorList[] = 'Email vide<br>';
            $formOk = false;
        }

        if ($formOk) {
            // Je vérifie l'email
            $check = new UsersModel();
            $userEmail = $check->emailExists($email);

            // Si email existe
            if ($userEmail > 0) {
                $usersModel = new UsersModel();
                $userData = $usersModel->getUserByUsernameOrEmail($email);
                // Je génère un token et je l'insert dans la db
                $token = Security\StringUtils::randomString(32);
                $userData = $usersModel->update(array(
                    'usr_token' => $token
                ), $userData['usr_id']);                
                
                // Je crée un lien de reset avec le token
                $resetUrl = $this->generateUrl('user_reset_pwd', array(
                    'token' => $token // token => [:token] in routes.php
                ));
                // Texte HTML à envoyer par e-mail
                $html = '<p>Une demande de reset de votre mot de passe nous a &eacute;t&eacute; demand&eacute;e. Veuillez utiliser le lien suivant pour valider :<a href="' . 'http://localhost' . $resetUrl . '">Changer mot de passe</a></p>';
                //$successList[] = $html;

                $subject = "Votre demande de changement mot de passe";

                // J'envoie l'email
                $this->envoieMail($html, $userData['usr_email'], $subject);
                // J'affiche en message de réussite avec un lien pour retourner à la page d'acceuil
                $successList[] = 'Un email contenant le lien pour le changement de votre mot de passe vous a été envoyé.<br />
                    Retour à l\'<a href=' . $this->generateUrl('default_home') . '>acceuil</a>
                    ';
            } else {
                $errorList[] = 'Email/Mot de passe inconnu(s)<br>';
            }
        }
        $this->show('user/lostpwdemail', array(
            'errorList' => $errorList,
            'email' => '',
            'successList' => $successList
        ));
    }
    
    public function resetpwd($token) {
        $this->show('user/resetpwd', array(
            'errorList' => array(),
            'password' => '',
            'password2' => '',
            'successList' => array()
        ));
    }
    
    public function resetpwdPost($token) {
        // J'initialise les variables nécessaires à récupérer les messages que je veux afficher lors d'une erreur ou de la réussite
        $errorList = array();
        $successList = array();

        // Je vérifie si $_POST n'est pas vide
        $formOK = true;
        if (!empty($_POST)) {
            // Je récupère les mots de passes fournis
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $password2 = isset($_POST['password2']) ? trim($_POST['password2']) : '';

            // Je vérifie les données
            if ($password === '' || $password2 === '') {
                $errorList[] = "Au moins un champ obligatoire est vide !";
                $formOK = false;
            }

            if (strlen($password) < 8 || strlen($password2) < 8) {
                $errorList[] = "Au moins 8 caractères !";
                $formOK = false;
            }

            if ($password2 != $password) {
                $errorList[] = "Les mots de passes renseignés ne sont pas identiques";
            }

            if (!isset($token) || $token === FALSE) {
                $formOK = false;
            }
            
            // J'appelle l'API Google-Captcha
            if ($this->googleCaptcha()) {
                $successList[] = "Captcha ok";
            } else {
                $errorList[] = "Pas de spammeurs ou de robots !";
                $this->show('user/resetpwd', array(
                    'errorList' => $errorList,
                    'password' => '',
                    'password2' => '',
                    'successList' => array()
                ));
            }

            // Si formulaire ok
            if ($formOK) {
                // Je crée une nouvelle instance du UsersModel
                $usersModel = new UsersModel();
                // Je récupère les données correspondants au token
                $userData = $usersModel->findByToken($token);
                // J'instancie un nouveau AuthentificationModel
                $authentificationModel = new AuthentificationModel();
                // Je mets à jour le mot de password de l'utilisateur dans la bd
                $userData = $usersModel->update(
                        array(
                            'usr_password' => $authentificationModel->hashPassword($password2),
                            'usr_token' => ''
                        ), $userData['usr_id']
                );

                // Si la modification a réussie
                if ($userData !== FALSE) {
                    $successList[] = 'Votre mot de passe a été changé. Retour à la page de connexion : <a href=' . $this->generateUrl('user_login') . '>Connexion</a>';
//                    $this->redirectToRoute('user_login');
                } else {
                    $errorList[] = "Le changement du mot de passe a échoué. Veuillez recommencer.";
                }
            }
        }
        $this->show('user/resetpwd', array(
            'errorList' => $errorList,
            'successList' => $successList
        ));
    }

    
    static function envoieMail($html, $emailAddress, $subject) {
        $mail = new \PHPMailer();
        $mail->isSMTP();
        $mail->Host = getApp()->getConfig('email_smtp');
        $mail->SMTPAuth = true;
        $mail->Username = getApp()->getConfig('email_username');
        $mail->Password = getApp()->getConfig('email_pwd');
        $mail->SMTPSecure = getApp()->getConfig('email_SMTPSecure');
        $mail->Port = getApp()->getConfig('email_port');
        $mail->setFrom(getApp()->getConfig('email_setFrom'));
        $mail->addAddress($emailAddress);
        $mail->addReplyTo(getApp()->getConfig('email_addReplyTo'));
        $mail->Subject = $subject;
        $mail->Body = $html;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    static function googleCaptcha() {
        $errorList = array();
        $successList = array();
        $captcha = '';
        
        // Vérifie si le captcha est présent
        $captcha = isset($_POST['g-recaptcha-response']) ? trim(strip_tags($_POST['g-recaptcha-response'])) : '';
        // Cléf secrète Google
        $secret = getApp()->getConfig('google_key');
        // Recupère l'adresse IP du client
        $address = $_SERVER['REMOTE_ADDR'];
        // Envoie une requête de vérification chez GOOGLE
        $answer = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$address");
        // Recupère la réponse
        $reply = json_decode($answer, TRUE);
        if ($reply['success']) {
            return true;
        } else {
            return false;
        }
    }
}
