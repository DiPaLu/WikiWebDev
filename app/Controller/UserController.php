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
        $this->show('user/login', array(
            'errorList' => array(),
            'email' => '',
            'successList' => array()
        ));
    }
    
    public function loginPost() {
        $errorList = array();
        $successList = array();
        
        //debug($_POST);
        
        $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $_SESSION['email'] = $email;

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
            //debug($userId);
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
        debug($_POST);
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

        if ($formOk) {
            $usersModel = new UsersModel();
            // Vérifier email inexistant
            if ($usersModel->emailExists($email)) {
                $errorList[] = 'L\'email existe déjà dans la base de données<br>';
            }
            if ($usersModel->getUserByUsernameOrEmail($pseudo)) {
                echo $pseudo;
                debug($usersModel);
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
                    'token' => $token, // token => [:token] in routes.php
                ]);
                // Texte HTML à envoyer par e-mail
                $html = '<p>Une demande de reset de votre password nous a été demandée. Veuillez utiliser le lien suivant pour valider :<a href="' . 'http://localhost' . $resetUrl . '">Renew password</a></p>';
                $successList[] = $html;

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
}
