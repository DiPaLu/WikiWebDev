<?php

namespace Model;

class AdminModel extends \W\Model\UsersModel {
    
    // Surchargement du constructeur pour définir le nom du champ primary key
    public function __construct() {
        parent::__construct();
        $this->setPrimaryKey('usr_id');
    }
    
    public function findByRole ($role) {
        
        if (!isset($role)) {
                return false;
        }
        
        $sql = '
            SELECT * 
            FROM users
        ';
        $sth = $this->dbh->prepare($sql);
        //$sth->bindValue(':token', $token);
        $sth->execute();
        
        return $sth->fetch();
    }
 
}
