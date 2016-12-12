<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use W\Security;
use \Model\UsersModel;

class UserController extends Controller {

    // Méthodes pour le formulaire login
    public function login() {
        //Affiche le formulaire login en GET
        $this->show('user/login');
    }
    
    public function loginPost() {
        //debug($_POST);
        $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Validation des données
        $formOk = true;
        if (empty($email)) {
            echo 'Email vide<br>';
            $formOk = false;
        }
        if (strlen($password) < 8) {
            echo 'Password de 8 caractères minimum<br>';
            $formOk = false;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo 'Email invalide<br>';
            $formOk = false;
        }

        if ($formOk) {
            // On vérifie email/password
            $auth = new AuthentificationModel();
            $userId = $auth->isValidLoginInfo($email, $password);
            //debug($userId);
            // Si login ok
            if ($userId > 0) {
                // Mise en session
                $usersModel = new UsersModel();
                $userData = $usersModel->find($userId);
                $auth->logUserIn($userData);
                // On redirige vers la home
                $this->redirectToRoute('default_home');
            } else {
                echo 'Email/Mot de passe non reconnus<br>';
            }
        }
    }

    public function signup() {
        // Je passe les variables à vide (initialise)
        $this->show('user/signup', array(
            'errorList' => array(),
            'email' => '',
            'successList' => array()
        ));
    }

    public function signupPost() {
        //debug($_POST);
        $errorList = array();
        $successList = array();

        $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $passwordConfirm = isset($_POST['password2']) ? trim($_POST['password2']) : '';

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
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'Email invalide<br>';
            $formOk = false;
        }
        if ($password != $passwordConfirm) {
            $errorList[] = 'Les mots de passe sont différents<br>';
            $formOk = false;
        }

        if ($formOk) {
            $usersModel = new UsersModel();
            // Vérifier email inexistant
            if ($usersModel->emailExists($email)) {
                $errorList[] = 'L\'email existe déjà dans la base de données<br>';
            } else {
                // On peut insérer
                $authentificationModel = new AuthentificationModel();
                $userData = $usersModel->insert(array(
                    'usr_pseudo' => '',
                    'usr_email' => $email,
                    'usr_password' => $authentificationModel->hashPassword($password),
                    'usr_role' => '0'
                ));
                // Si l'insertion a fonctionné
                if ($userData !== false) {
                    $authentificationModel->logUserIn($userData);
                    // On redirige vers la home
                    $this->redirectToRoute('default_home');
                } else {
                    $errorList[] = 'erreur dans l\insertion<br>';
                }
            }
        }
        $this->show('user/signup', array(
            'errorList' => $errorList,
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
/*
    public function lostpwdemailPost() {
        //debug($_POST);
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

            //var_dump($userEmail);

            // Si email existe
            if ($userEmail > 0) {
                $usersModel = new UsersModel();
                $userData = $usersModel->getUserByUsernameOrEmail($email);
                debug($userData);
                // Je génère un token et je l'insert dans la db
                $token = Security\StringUtils::randomString(32);
                var_dump($token);
                $authentificationModel = new AuthentificationModel();
                $userData = $usersModel->update(
                        [
                    'usr_token' => $token,
                        ], $userData['usr_id']
                );
                // Je crée un lien de reset avec le token
                $resetUrl = $this->generateUrl('user_reset_pwd', [
                    'toto' => $token, // toto entspricht [:toto] in routes.php
                ]);
                // Texte HTML à envoyer par e-mail
                $html = '<p>Une demande de reset de votre password nous a été demandée. Veuillez utiliser le lien suivant pour valider :<a href="' . 'http://localhost' . $resetUrl . '">Renew password</a></p>';
                echo $html;

                $subject = "Votre demande de changement mot de passe";

                // J'envoie l'email
                $this->envoieMail($html, $userData['usr_email'], $subject);
                // J'affiche en message de réussite avec un lien pour retourner à la page d'acceuil
                $successList[] = 'Un email contenant le lien pour le changement de votre mot de passe vous a été envoyé.<br />
                    Retour à l\'<a href=' . $this->generateUrl('default_home') . '>acceuil</a>
                    ';
            } else {
                echo 'Email/Mot de passe inconnu(s)<br>';
            }
        }
        $this->show('user/lostpwdemail', array(
            'errorList' => array(),
            'email' => '',
            'successList' => $successList
        ));
    }

    public function resetpwd($token) {
        //echo $token;
        $this->show('user/resetpwd', array(
            'errorList' => array(),
            'successList' => array()
        ));
    }

    public function resetpwdPost($token) {
        echo $token;
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

            if (strlen($password < 8 || $password2 < 8)) {
                $errorList[] = "Au moins 8 caractères !";
                $formOK = false;
            }

            if ($password2 != $password) {
                $errorList[] = "Les mots de passes renseignés ne sont pas identiques";
            }

            if (!isset($token) || $token === FALSE) {
                $formOK = false;
            }

            // Si formulaire ok
            if ($formOK) {
                // Je crée une nouvelle instance du UsersModel
                $usersModel = new UsersModel();
                // Je récupère les données correspondants au token
                $userData = $usersModel->findByToken($token);
                debug($userData);
                // J'instancie un nouveau AuthentificationModel
                $authentificationModel = new AuthentificationModel();
                // Je mets à jour le mot de password de l'utilisateur dans la bd
                $userData = $usersModel->update(
                        array(
                            'usr_password' => $authentificationModel->hashPassword($password2),
                            'usr_token' => ''
                        )
                        , $userData['usr_id']
                );

                // Si la modification a réussie
                if ($userData !== FALSE) {
                    $successList[] = 'Votre mot de passe a été changé. Vous allez être rédirigé dans 2 secondes. Si la redirection automatique ne fonctionne pas, veuillez cliquer sur ce lien : <a href=' . $this->generateUrl('user_login') . '>Login</a>';
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
        //debug($_POST);
    }

    static function envoieMail($html, $emailAddress, $subject) {
        $mail = new \PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mail.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'turbo2401@icqmail.com';
        $mail->Password = file_get_contents(dirname(__FILE__) . '/pwd.txt');
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('turbo2401@icqmail.com', 'turbo2401');
        $mail->addAddress($emailAddress);
        $mail->addReplyTo('turbo2401@icqmail.com', 'Information');
        $mail->Subject = $subject;
        $mail->Body = $html;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }*/
}
