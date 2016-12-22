<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \Model\TermsModel;
use \Model\DefinitionModel;

/**
 * Description of admin
 *
 * @author Etudiant
 */
class AdminController extends Controller {

    public $terID;

    public function getAdmin() {
        $loggedUser = $this->getUser();
//debug($loggedUser);
        $usersModel = new UsersModel();
        $usersList = $usersModel->getAllUsers();
        $termsModel = new TermsModel();
        $termsList = $termsModel->getTerms();    
        $definitionModel = new DefinitionModel();
        $definitionsList = $definitionModel->getDefinition();
 
        $this->allowTo(array('1', '2'));


        $this->show('admin/admin', array(
            'usersList' => $usersList,
            'termsList' => $termsList,
            'definitionsList' => $definitionsList,            
        ));
    }
    
    public function getAdminPost() {     
        
        $loggedUser = $this->getUser();
        //debug($loggedUser);
        $usersModel = new UsersModel();
        $usersList = $usersModel->getAllUsers();
        
        $termsModel = new TermsModel();
        $termsList = $termsModel->getTerms();
        
        $terId=0;
        $validateTerm = $termsModel->validateTerm($terId);    
        
        //debug($validateTerm);
        
        $definitionModel = new DefinitionModel();
        $definitionsList = $definitionModel->getDefinition();
        
        if (!empty($_POST['validate-term'])) {
        
        //Valider term
        echo 'button validate ok';                                
        
        }
        if (!empty($_POST['delete-term'])) {
            
        //Supprimer terme
            echo 'button delete ok';            
        }
        if (!empty($_POST['validate-definition'])) {
        
        //Valider definition
        echo 'button validate ok';                                
        
        }
        if (!empty($_POST['delete-definition'])) {
            
        //Supprimer definition
            echo 'button delete ok';            
        }
               
        $this->allowTo(array('1', '2'));

        $this->show('admin/admin', array(
            'usersList' => $usersList,
            'termsList' => $termsList,
            'definitionsList' => $definitionsList,
            'validateTerm' => $validateTerm
        ));    
    
    }
    
    

    /*
      public function validateTerm($terId){
      $termsModel = new TermsModel();
      $validateTerm = $termsModel->validateTerm($terId);
      debug($validateTerm);
      exit;

      $this->show('admin/admin', array(
      'validateTerm' => $validateTerm
      ));
      }
     */
}
