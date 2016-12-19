<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\TermsModel;
use \Model\CategoryModel;
use \W\Model\Model;

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
	 * Methode qui tri les mots par category
	 */
	public function getTermsByCategory(){
		$this->show('lexique/terms');
	}
	/**
	 * methode qui propose d'ajouter une définition au mot choisi
	 */
	public function getTermsAdd($termsId) {
            $defModel = new TermsModel();
            $resultList = $defModel->getTermsDetails($termsId);
            if($resultList[0]['ter_name']){
                $nom = $resultList[0]['ter_name'];  
            } else {
                $this->showNotFound() ;
            }
            $this->show('lexique/termsAddDetails', array(
                'nom' => $nom,
                'errorList' => array(),
                'successList' => array()
            ));
	}
	
	/**
	 * methode qui propose une définition
	 */
	public function getTermsAddPost($termsId) {
            $errorList = array();
            $successList = array();
            
            $definition = isset($_POST['definition']) ? trim($_POST['definition']) : '';
            $formOk = true;
            
            if(empty($definition)){
                $errorList[] = 'Definition vide<br/>';
                $formOk = false;
            }
            
             $defModel = new TermsModel();
             $resultList = $defModel->getTermsDetails($termsId);
            if($resultList[0]['ter_name']){
                $nom = $resultList[0]['ter_name'];  
            } else {
                $this->showNotFound() ;
            }
            
            if($formOk){
                $modelTerm = new \Model\DefinitionModel();
                $connectedAdmin = $this->getUser();
                $modelTerm->insert(array(
                   'def_status' => 'Pending',
                    'def_description' => $definition,
                    'terms_ter_id' => $resultList[0]['ter_id'],
                    'users_usr_id' => $connectedAdmin['usr_id']
                ));
                $successList[] = 'La définition sera ajouté après vérification de l\'admin';
            }
            
            $this->show('lexique/termsAddDetails', array(
                'nom' => $nom,
                'errorList' => $errorList,
                'successList' => $successList
            ));
            
	}

}
