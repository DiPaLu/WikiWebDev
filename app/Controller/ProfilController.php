<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \W\Security\AuthentificationModel;

class ProfilController extends Controller{


    public function parametre(){
        $this->show('profil/parametre', array(
            'errorList' => array(),
            'successList' => array()
        ));
    }

    public function parametrePost(){
        $errorList = array();
        $successList = array();

        $pseudo = isset($_POST['pseudo']) ? trim(strip_tags($_POST['pseudo'])) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $formOk = true;

        if(empty($pseudo)){
            $errorList[] = 'Pseudo vide<br/>';
            $formOk = false;
        }

        if(empty($email)){
            $errorList[] = 'Email vide<br/>';
            $formOk = false;
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'Email invalide<br>';
            $formOk = false;
        }

        $usersModel = new UsersModel();

        if($usersModel->emailExists($email)){
            $errorList[] = 'L\'email existe déjà dans la base de données <br/>';
            $formOk = false;
        }

        if($usersModel->getUserByUsernameOrEmail($pseudo)){
            $errorList[] = 'Pseudo déjà utilisé <br/>';
            $formOk = false;
        }

        $connected = $this->getUser();

        if($formOk){
            $auth = new AuthentificationModel();
            $userData = $usersModel->update(array(
                'usr_pseudo' => $pseudo,
                'usr_email' => $email,
            ), $connected['usr_id']);

            if($userData !== false){
                $successList = 'La modification a bien été faite!';
                $auth->refreshUser();
            }
        }
        
        $this->show('profil/parametre', array(
            'errorList' => $errorList,
            'pseudo' => $pseudo,
            'email' => $email,
            'successList' => $successList
        ));
    }

    public function delete(){
        $this->show('profil/delete', array(
            'errorList' => array(),
            'successList' => array()
        ));
    }
    
    public function deletePost(){
        echo "malika";
        $loggedUser = $this->getUser();
        $email = $loggedUser['usr_email'];
        $password = isset($_POST['password']) ? trim(strip_tags($_POST['password'])) : '';
        $formOk = true;
        
        if (empty($password)) {
            $errorList[] = 'Password vide<br>';
            $formOk = false;
        }
        
        if($formOk){
            $auth = new AuthentificationModel();
            $userId = $auth->isValidLoginInfo($email, $password);
            if($userId > 0){
                $usersModel = new UsersModel();
                $usersModel->delete($userId);
                $sucessList[] = 'Votre compte a été supprimé';
                $this->redirect('default_home');
            }else{
                $errorList[] = 'Mot de passe incorrect<br/>';
            }
        }
        
        $this->show('profil/delete');
    }

    public function profil($pseudo){
        if($pseudo != '[:pseudo]'){
            $profModel = new UsersModel();
            $prof=$profModel->getUserByUsernameOrEmail($pseudo);
            $pseudo = $prof['usr_pseudo'];
            $dateInscription = $prof['usr_insert_date'];
            $dateDerniereConnection = $prof['usr_last_connected'];
            $avatar = $prof['usr_avatar'];
            $pseudoUtilisateur = 'no';
        } else {
            $connected = $this->getUser();
            $pseudo = $connected['usr_pseudo'];
            $dateInscription = $connected['usr_insert_date'];
            $dateDerniereConnection = $connected['usr_last_connected'];
            $avatar = $connected['usr_avatar'];
            $pseudoUtilisateur = 'yes';
        }
        
        $this->show('profil/profil', array(
            'pseudo' => $pseudo,
            'dateInscription' => $dateInscription,
            'dateDerniereConnection' => $dateDerniereConnection,
            'avatar' => $avatar,
            'pseudoUtilisateur' => $pseudoUtilisateur
        ));
    }
}
