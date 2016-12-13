<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \W\Security\AuthentificationModel;

class ProfilController extends Controller{
    
    public function config(){
        
       $data = $this->getUser();
       print_r($data);
        
        $this->show('profil/config', array(
            'email' => $data['usr_email']
        ));
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