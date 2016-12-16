<?php

namespace Model;

class AdminModel extends \W\Model\UsersModel {
    
    // Surchargement du constructeur pour définir le nom du champ primary key
    public function __construct() {
        parent::__construct();
        $this->setPrimaryKey('usr_id');
    }
    
    public function getAllUsers (){
        $sql = '
            SELECT *
            FROM users
           
        ';
        $stmt = $this->dbh->prepare($sql);
                
        if ($stmt->execute() === false) {
            debug($stmt->errorInfo());
        }
        else {
            return $stmt->fetchAll();
        }
        return false;
    }     
