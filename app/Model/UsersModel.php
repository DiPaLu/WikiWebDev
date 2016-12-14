<?php

namespace Model;

use \W\Model\UsersModel;

/**
 * Description of UsersModel
 *
 * @author Etudiant
 */
class UsersModel extends UsersModel {

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

}
