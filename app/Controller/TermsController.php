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
		//j'instancie la class TermsModel et lance la methode getTerms
		$defModel = new TermsModel();
		$resultList = $defModel->getTerms();
		//debug($resultList);
		//
		//j'instancie la class CategoryModel et lance la methode
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
		//j'instancie la class TermsModel et lance la methode
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
		
		// recuperation du champ de recherche
		$searchform = isset($_POST['search']) ? strip_tags($_POST['search']) : '';
		
		// Validation des données
		$formOk = true;
		if(empty($searchform)){
			echo 'il n\'y a rien à chercher!';
			$formOk = false;
            }
		if ($formOk) {
		//j'instancie la class TermsModel et lance la methode
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
	public function getTermsByCategory(){
		$this->show('lexique/terms');
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
