<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\TermsModel;
use \Model\CategoryModel;
use \Model\UsersModel;


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
		//je récupère tous les mots + définitions dans la bdd
		$defModel = new TermsModel();
		$resultList = $defModel->getTerms();
		//debug($resultList);
		//
		//je récupère toutes les categories dans la bdd
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
	public function getTermsDetails($termsId) {
		//Je récupère un mot et ses définitions dans la bdd
		$detModel = new TermsModel();
		$detailsTerms = $detModel->getTermsDetails($termsId);
		//debug($detailsTerms);
		$this->show('lexique/termsDetails', array(
		    'detailsTerms' => $detailsTerms,
		));
	}
	
	/**
	 * Methode qui affiche le formulaire en GET
	 */
	public function getTermsBySearch() {
		
		$this->show('lexique/terms');
	}
	
	/**
	 * Methode qui affiche les resultats de la recherche
	 */
	public function getTermsBySearchPost() {
		
		// je recupere le contenu du champ de recherche
		$searchform = isset($_POST['search']) ? strip_tags($_POST['search']) : '';
		
		// Validation des données
		$formOk = true;
		if(empty($searchform)){
			echo 'il n\'y a rien à chercher!';
			$formOk = false;
            }
		if ($formOk) {
		// Je récupère le resultat de la recherche dans la bdd
		$termsModel = new TermsModel();
		$searchResult = $termsModel->getTermsBySearch($searchform);
		//debug($searchResult);
		}
		//je defini des variables pour la vue
		$this->show('lexique/termsBySearch', array('searchResult' => $searchResult,
		    ));
	}

	/**
	 * Methode qui tri les mots par category
	 */
	public function getTermsByCategory($catId){

		//je récupère les catégories dans la bdd
		$catModel = new CategoryModel();
		$categoryList = $catModel->getCategory();
		//debug($categoryList);
		
		//Je récupère les mots d'une categorie dans la bdd
		$defModel = new TermsModel();
		$resultList = $defModel->getTermsByCategory($catId);
		//debug($resultList);
		//j'initialise mes variables
		$currentId = 0;
		//debug($categoryList);

		//je defini des variables pour la vue
		$this->show('lexique/termsByCategory', array(
		    'resultList' => $resultList,
		    'categoryList' => $categoryList,
		    'currentId' => $currentId
		));
	}
	
	/**
	 * methode qui propose d'ajouter une définition au mot choisi
	 */
	public function getTermsAdd($termsId) {
   		$this->show('lexique/termsAddDetails');
	}
	
	/**
	 * methode qui propose un mot ou une définition
	 */
	public function getTermsAddPost() {
		$this->show('lexique/termsAdd');
	}

}
