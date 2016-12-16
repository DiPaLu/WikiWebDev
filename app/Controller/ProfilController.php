<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \W\Security\AuthentificationModel;

class ProfilController extends Controller{
 
    
    public function parametre(){
        $this->show('profil/parametre');
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
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'Email invalide<br>';
            $formOk = false;
        }
        if(empty($email)){
            $errorList[] = 'Email vide<br/>';
            $formOk = false;
        }
    }
    
    public function delete(){
        $this->show('profil/delete');
    }
    
    public function profil(){
        
        $data = $this->getUser();

        
        $this->show('profil/profil');

    }  
}


/*require 'inc/config.php';
$infoUser = array();

$idUser = isset($_POST['id']) ? intval($_POST['id']) : 0;

$sql = 'SELECT * FROM users WHERE usr_id=:id';

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':id', $idUser, PDO::PARAM_INT);

if(!pdoStatement->execute()){
	print_r($pdoStatement->errorInfo());
}else{
	$infoUser = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
}



*/