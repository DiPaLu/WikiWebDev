<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \W\Security\AuthentificationModel;

class ProfilController extends Controller{
    
    public function parametre(){
        
        $data = $this->getUser();
        
        $this->show('profil/parametre', array(
            'email' => $data['usr_email']
        ));
    }
    
    public function delete(){
        $this->show('profil/delete');
    }
    
    public function profil(){
        
        $data = $this->getUser();
        
        $this->show('profil/profil', array(
            'pseudo' => $data['usr_pseudo'],
            'email' => $data['usr_email'],
            'date' => $data['usr_insert_date'],
            'drnConnexion' => $data['usr_last_connected']
        ));
    }
    
    public function update() {
        // votre code ici ...
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