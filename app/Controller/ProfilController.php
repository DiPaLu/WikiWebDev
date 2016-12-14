<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \W\Security\AuthentificationModel;

class ProfilController extends Controller{
 
    
    public function parametre(){
        
        $this->show('profil/parametre');
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