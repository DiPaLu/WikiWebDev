<?php

namespace Model;

/**
 * Description of CategoryModel
 *
 * @author Paul
 */
class CategoryModel extends \W\Model\Model {

	// Je surcharge le constructeur pour définir le nom du champ PK
	public function __construct() {
		parent::__construct();
		$this->setPrimaryKey('cat_id');
	}

	/**
	 * 
	 * @return boolean
	 */
	public function getCategory() {

		$sql = '
		SELECT *
		FROM ' . $this->table . '
		ORDER BY cat_name ASC
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
