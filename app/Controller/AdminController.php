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
        
        $this->allowTo(array('1', '2'));
        
        $loggedUser = $this->getUser();
        //debug($loggedUser);
        $usersModel = new UsersModel();
        $usersList = $usersModel->getAllUsers();
        $termsModel = new TermsModel();
        $termsList = $termsModel->getAllTerms();
        //debug($termsList);
        $definitionModel = new DefinitionModel();
        $definitionsList = $definitionModel->getPendingDefinition();
 
        
        $this->show('admin/admin', array(
            'usersList' => $usersList,
            'termsList' => $termsList,
            'definitionsList' => $definitionsList,            
        ));
    }
    
    public function getAdminPost() { 
        
        $this->allowTo(array('1', '2'));       
                
        $loggedUser = $this->getUser();
        //debug($loggedUser);
        $usersModel = new UsersModel();
        $usersList = $usersModel->getAllUsers();
        
        $termsModel = new TermsModel();
        $termsList = $termsModel->getAllTerms();
           
                    
        $definitionModel = new DefinitionModel();
        $definitionsList = $definitionModel->getPendingDefinition();
        
        if (!empty($_POST['validate-term'])) {
        
        //Valider term
        $terId = $_POST['ter-id'];
        $validateTerm = $termsModel->validateTerm($terId);
               
        }
        if (!empty($_POST['delete-term'])) {
            
        //Supprimer terme
        $terId = $_POST['ter-id'];
        $deleteTerm = $termsModel->deleteTerm($terId);  
                
        }
        if (!empty($_POST['validate-definition'])) {
        
        //Valider definition
        $defId = $_POST['def-id'];
        $validateDefinition = $definitionModel->validateDefinition($defId);                         
        
        }
        if (!empty($_POST['delete-definition'])) {
            
        //Supprimer definition
        $defId = $_POST['def-id'];
        $deleteDefinition = $definitionModel->deleteDefinition($defId);             
        }              
            
        $this->show('admin/admin', array(
            'usersList' => $usersList,
            'termsList' => $termsList,
            'definitionsList' => $definitionsList,
            //'validateTerm' => $validateTerm,
            //'deleteTerm' => $deleteTerm
        ));       
    }   
    
    public function moveToUser(){
        //debug($_POST);
        $userId = $_POST['id'];
        $usersModel = new UsersModel;
        $moveToUser = $usersModel->moveToUser($userId);
        
        $this->showJson(1);
    }
    
    public function moveToModerator(){
        //debug($_POST);
        $userId = $_POST['id'];
        $usersModel = new UsersModel;
        $moveToModerator = $usersModel->moveToModerator($userId);
        
        $this->showJson(1);
    }
    public function moveToAdmin(){
        //debug($_POST);
        $userId = $_POST['id'];
        $usersModel = new UsersModel;
        $moveToAdmin = $usersModel->moveToAdmin($userId);
        
        $this->showJson(1);
    }
   
}
