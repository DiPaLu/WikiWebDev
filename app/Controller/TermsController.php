<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\TermsModel;


/**
 * Description of LexiqueController
 *
 * @author Etudiant
 */
class TermsController extends Controller {

	public function getTerms() {
		$loggedUser = $this->getUser();
		//var_dump($loggedUser);
		
		$defModel = new TermsModel();
		$resultList = $defModel->getTerms();
		//debug($resultList);
		$this->show('lexique/terms', array(
		    'resultList' => $resultList,
		));
	}
        
        public function getTermsDetails() {
            // votre code ici ...
        }
        
        public function getTermsAdd() {
            // votre code ici ...
        }
        
        public function getTermsAddPost() {
            // votre code ici ...
        }
}
