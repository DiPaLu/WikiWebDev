<?php

namespace Model;


/**
 * Description of UsersModel
 *
 * @author Patrick
 */
class UsersModel extends \W\Model\UsersModel {

    // Je surcharge le constructeur pour définir le nom du champ PK
    public function __construct() {
        parent::__construct();
        $this->setPrimaryKey('usr_id');
    }
    
   /** @var string $usrtoken Le champ a récupérer du tableau  */
    protected $usrtoken = 'usr_token';
    /**
	 * Récupère les données dans la db en fonction du token
	 * @param  token
	 * @return mixed Les données sous forme de tableau associatif
	 */
    public function findByToken($token) {

        if (!isset($token)) {
            return false;
        }

        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->usrtoken . '  = :token LIMIT 1';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':token', $token);
        $sth->execute();

        return $sth->fetch();
    }
    /*
    Remplacer par findAll: comment?
    */
    
    public function getAllUsers (){
        $sql = '
            SELECT *
            FROM '.$this->table.'
            ORDER BY usr_pseudo
           
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
    
    public function getProfil() {
        $sql = '
        SELECT *
        FROM ' . $this->table . '
        ORDER BY usr_id ASC
        ';

        $stmt = $this->dbh->prepare($sql);

        if ($stmt->execute() === false) {
                debug($stmt->errorInfo());
        } else {
                return $stmt->fetchAll();
        }
        return false;
    }
    
    public function getId($pseudo){
        $sql = 'SELECT usr_id FROM '.$this->table.' WHERE usr_pseudo = '.$pseudo;
        debug($sql);
        $stmt = $this->dbh->prepare($sql);

        if ($stmt->execute() === false) {
                debug($stmt->errorInfo());
        } else {
                return $stmt->fetchAll();
                debug($stmt);
        }
        return false;
           
    }

}
