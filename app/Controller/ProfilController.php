<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \Security\AuthentificationModel;

class ProfilController extends Controller{


public function parametre(){
    $this->show('profil/parametre', array(
        'errorList' => array(),
         'successList' => array()
    ));
}

public function parametrePost(){

    $connected = $this->getUser();
    $id = $connected['usr_id'];
    $auth = new \W\Security\AuthentificationModel();
    //initialisation des tableau d'erreur ou de reussite
    $errorList = array();
    $successList = array();
    //ce que je recois en post
    $pseudoFormulaire = isset($_POST['pseudoFormulaire']) ? $_POST['pseudoFormulaire'] : 0;
    $emailFormulaire = isset($_POST['emailFormulaire']) ? $_POST['emailFormulaire'] : 0;
    $passwordFormulaire = isset($_POST['passwordFormulaire']) ? $_POST['passwordFormulaire'] : 0;
    $pseudo = isset($_POST['pseudo']) ? trim(strip_tags($_POST['pseudo'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim(strip_tags($_POST['password'])) : '';
    $ancienPassword = isset($_POST['ancienPassword']) ? trim(strip_tags($_POST['ancienPassword'])) : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? trim(strip_tags($_POST['confirmPassword'])) : '';
    $formOk = true;
    $usersModel = new UsersModel();
    $max = isset($_POST['MAX_FILE_SIZE']) ? $_POST['MAX_FILE_SIZE'] : '';

    //pseudo
    if($pseudoFormulaire == 1){
        if(empty($pseudo)){
            $errorList[] = 'Pseudo vide<br/>';
            $formOk = false;
        }

        if($usersModel->getUserByUsernameOrEmail($pseudo)){
            $errorList[] = 'Pseudo déjà utilisé <br/>';
            $formOk = false;
        }

        if($formOk){
            $usersModel->update(array(
            'usr_pseudo' => $pseudo
            ), $id);

            $auth = new AuthentificationModel();
            $auth->refreshUser();
        }
    }
    //avatar
    debug($max);
    if($max == 1){
        if($_FILES['file']['size']){
            $file = $_FILES['file'];
            $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

            $extension = strtolower(substr(strrchr($file['name'], '.'), 1));
            //strrchr renvoie l'extension avec le point '.'
            //substr(chaine, 1) ignore le premier caractère de chaine, cest a dire le point
            //strotolower met l'extension en minuscules
                if(!in_array($extension, $extensions_valides)){
                    $formOk = false;
                    $errorList[] = 'Extension incorrecte';
                }
            //debug($file);
            $resultat = move_uploaded_file($file['tmp_name'], __AVATAR_UPLOAD_DIR__.$id.'.'.$extension);
            // debug($extension);
            $chemin = __AVATAR_UPLOAD_DIR__.$id.'.'.$extension;

            //debug($chemin);
            // $img = strrchr($chemin, '/');
            $avatar = substr(strrchr($chemin, "s"), 2);

            $usersModel->update(array(
            'usr_avatar' => $avatar
            ), $id);

            $auth = new AuthentificationModel();
            $auth->refreshUser();

                if(!$resultat){
                    $formOk = false;
                    $errorList[] = 'erreur lors du transfert';
                }
            } else {
                $errorList[] = 'il faut d\'abord choisir un avatar';
            }
    }

    //email
    if($emailFormulaire == 1){
        if(empty($email)){
         $errorList[] = 'Email vide<br/>';
            $formOk = false;
        }else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'Email invalide<br>';
            $formOk = false;
        }

        if($usersModel->emailExists($email)){
            $errorList[] = 'L\'email existe déjà dans la base de données <br/>';
            $formOk = false;
        }


        if($formOk){
            $auth = new AuthentificationModel();
            $userData = $usersModel->update(array(
                'usr_email' => $email,
            ), $connected['usr_id']);

            if($userData !== false){
            $successList[] = 'La modification a bien été faite!';
            $auth->refreshUser();
            }
        }
    }


    //password
    if(empty($ancienPassword)){
        $errorList[] = 'Ancien password vide';
        $formOk = false;
        if(empty($password)){
            $errorList[] = 'Password vide';
            $formOk = false;
            if(empty($confirmPassword)){
                $errorList[] = 'Confirmation de password vide';
                $formOk = false;
            }
            
            if($password != $confirmPassword){
                $errorList[] = 'Les passwords ne sont pas identiques';
                $formOk = false;
            }
        }
    }
    
    if($formOk){
        $data = $usersModel->update(array(
            'usr_password' => $auth->hashPassword($password)
        ), $id);
        
        if($data !== FALSE){
            $successList[] =  'Le mot de passe a été changé';
        }
    }
    
    
    

    $this->show('profil/parametre', array(
        'errorList' => $errorList,
         'pseudo' => $pseudo,
         'email' => $email,
         'successList' => $successList,
        ));
    }

    public function delete(){
    $this->show('profil/delete', array(
    'errorList' => array(),
     'successList' => array()
    ));
    }

    public function deletePost(){
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
    $sucessList[] = 'Compte supprimé avec succes';
    $auth->logUserOut();
    }

    $this->show('lexique/terms');
    }

public function profil($pseudo){
$profModel = new UsersModel();
$termModel = new \Model\TermsModel();
$prof = $profModel->getUserByUsernameOrEmail($pseudo);
$connected = $this->getUser();

if($pseudo != '[:pseudo]'){
$id = $connected['usr_id'];
$pseudo = $prof['usr_pseudo'];
$dateInscription = $prof['usr_insert_date'];
$dateDerniereConnection = $prof['usr_last_connected'];
$avatar = $prof['usr_avatar'];
$pseudoUtilisateur = 'no';
} else {
$id = $connected['usr_id'];
$pseudo = $connected['usr_pseudo'];
$dateInscription = $connected['usr_insert_date'];
$dateDerniereConnection = $connected['usr_last_connected'];
$avatar = $connected['usr_avatar'];
$pseudoUtilisateur = 'yes';
}
$nbMot = $termModel->getNombreMot($id);

$this->show('profil/profil', array(
'pseudo' => $pseudo,
 'dateInscription' => $dateInscription,
 'dateDerniereConnection' => $dateDerniereConnection,
 'avatar' => $avatar,
 'pseudoUtilisateur' => $pseudoUtilisateur,
 'nbMot' => $nbMot
));
}
}
