<?php

namespace Model;


/**
 * Description of UsersModel
 *
 * @author Etudiant
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
    J'ai écrit cette methode ici puis je l'ai dupliqué dans AdminModel. Est-ce qu'on la laisse ici u on la supprime? Qulequ'un en a besoin?
    Pareil dans le  Controlleur.
    */
    /*
    public function getAllUsers (){
        $sql = '
            SELECT *
            FROM '.$this->table.'
           
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
    */

}
