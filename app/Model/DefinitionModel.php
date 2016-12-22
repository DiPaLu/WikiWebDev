<?php

namespace Model;

/**
 * Description of CategoryModel
 *
 * 
 */
class DefinitionModel extends \W\Model\Model {

	// Je surcharge le constructeur pour définir le nom du champ PK
	public function __construct() {
		parent::__construct();
		$this->setPrimaryKey('def_id');
	}          
        
        public function getPendingDefinition() {
                                
		$sql = '
		SELECT *
		FROM ' . $this->table . '
                INNER JOIN terms ON terms.ter_id = definition.terms_ter_id
                INNER JOIN users ON definition.users_usr_id = users.usr_id
                WHERE def_status = 2
		ORDER BY def_add_date DESC
		';

		$stmt = $this->dbh->prepare($sql);

		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return $stmt->fetchAll();
		}
		return false;
	}
        
        public function validateDefinition($defId){
                $sql = '
		UPDATE definition
                SET def_status = 1
                WHERE def_id = :defId;
                ';
                
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(':defId', $defId);
		
		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return true;
		}
                return false;
                
        }
        
        public function deleteDefinition($defId){
                $sql = '
		DELETE FROM definition
                WHERE def_id = :defId;
                ';
                
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(':defId', $defId);
		
		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return true;
		}
                return false;               
        }  
        
       
        

}
