<?php

namespace Model;

/**
 * Description of LexiqueModel
 *
 * @author Paul
 */
class TermsModel extends \W\Model\Model{
	// Je surcharge le constructeur pour définir le nom du champ PK
    public function __construct() {
        parent::__construct();
        $this->setPrimaryKey('ter_id');
    }

    /**
     * 
     * @param type $termsId
     * @return boolean
     */
    public function getTerms() {
        $sql = '
            SELECT *
            FROM '.$this->table.'
            INNER JOIN definition ON terms.ter_id = definition.terms_ter_id
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
}