<?php

namespace Model;


/**
 * Description of LexiqueModel
 *
 * @author Paul
 */
class TermsModel extends \W\Model\Model {

	// Je surcharge le constructeur pour définir le nom du champ PK
	public function __construct() {
		parent::__construct();
		$this->setPrimaryKey('ter_id');
	}

	/**
	 * recupere tous les mots
	 * @return boolean
	*/
	public function getTerms() {
		$sql = '
		SELECT *
		FROM ' . $this->table . '
		INNER JOIN definition ON terms.ter_id = definition.terms_ter_id
		INNER JOIN users ON terms.users_usr_id = users.usr_id
		GROUP BY terms.ter_id
		ORDER BY terms.ter_name
		';

		$stmt = $this->dbh->query($sql);

		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return $stmt->fetchAll();
		}
		return false;
	}
	
	/**
	 * recupere un mot en detail et ses définitions
	 * @return boolean
	*/
	public function getTermsDetails($termsId) {

		$sql = '
		SELECT *
		FROM ' . $this->table . '
		INNER JOIN definition ON terms.ter_id = definition.terms_ter_id
		WHERE terms.ter_id = :termsId
		AND definition.def_status = :Validated
		';
		
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':termsId', $termsId);
		$stmt->bindValue(':Validated', 'Validated');

		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return $stmt->fetchAll();
		}
		return false;
	}
        
        

	
	/**
	 * recupere le resultat de la recherche
	 * @return boolean
	*/
	public function getTermsBySearch($search) {
		
		$sql = '
		SELECT *
		FROM ' . $this->table . '
		INNER JOIN definition ON terms.ter_id = definition.terms_ter_id
		WHERE terms.ter_id LIKE :search
		OR definition.def_description LIKE :search
		OR terms.ter_tags LIKE :search
		';
		
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':search', '%'.$search.'%');

		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return $stmt->fetchAll();
		}
		return false;
	}
	
	/**
	 * recupere le resultat du select category
	 * @return boolean
	*/
	public function getTermsByCategory($catId) {
		
		$sql = '
		SELECT *
		FROM ' . $this->table . '
		INNER JOIN definition ON terms.ter_id = definition.terms_ter_id
		WHERE category_cat_id = :catId
		';
		//INNER JOIN terms.category_cat_id = catergory.cat_id
		
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':catId', $catId);

		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return( $stmt->fetchAll());
		}
		return false;
	}
	
}