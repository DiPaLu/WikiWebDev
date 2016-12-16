<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\TermsModel;
use \Model\CategoryModel;


/**
 * Description of LexiqueController
 *
 * @author Paul
 */
class TermsController extends Controller {

	/**
	 * methode qui récupère tous les mots + définitions
	 */
	public function getTerms() {
		//$loggedUser = $this->getUser();
		//var_dump($loggedUser);
		//j'instancie la class TermsModel et lance la methode getTerms
		$defModel = new TermsModel();
		$resultList = $defModel->getTerms();
		//debug($resultList);
		
		$catModel = new CategoryModel();
		$categoryList = $catModel->getCategory();
		//j'initialise mes variables
		$currentId = 0;
		//debug($categoryList);

		//je defini des variables pour la vue
		$this->show('lexique/terms', array(
		    'resultList' => $resultList,
		    'categoryList' => $categoryList,
		    'currentId' => $currentId
		));
	}

	/**
	 * methode qui récupère un mot et ses définitions
	 */
	public function getTermsDetails() {
		//j'instancie la class TermsModel et lance la methode getTerms
		$detModel = new TermsModel();
		$detailsTerms = $detModel->getTermsDetails($termsId, $terms);
		//debug($detailsTerms);
		$this->show('lexique/termsDetails', array(
		    'detailsTerms' => $detailsTerms,
		));
	}
	/**
	 * methode qui propose d'ajouter une définition au mot choisi
	 */
	public function getTermsAdd() {
		$this->show('lexique/termsAddDetails');
	}
	
	/**
	 * methode qui propose un mot ou une définition
	 */
	public function getTermsAddPost() {
		$this->show('lexique/termsAdd');
	}

}
