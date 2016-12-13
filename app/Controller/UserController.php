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
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'Email invalide<br>';
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

}
