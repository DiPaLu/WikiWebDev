<?php

namespace Model;

/**
 * Description of CategoryModel
 *
 * @author Paul
 */
class DefinitionModel extends \W\Model\Model {

	// Je surcharge le constructeur pour définir le nom du champ PK
	public function __construct() {
		parent::__construct();
		$this->setPrimaryKey('def_id');
	}

	/**
	 * 
	 * @return boolean
	 */
	public function getDefinition() {

		$sql = '
		SELECT *
		FROM ' . $this->table . '
		ORDER BY def_id ASC
		';

		$stmt = $this->dbh->prepare($sql);

		if ($stmt->execute() === false) {
			debug($stmt->errorInfo());
		} else {
			return $stmt->fetchAll();
		}
		return false;
	}

}
