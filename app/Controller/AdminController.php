<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \Model\TermsModel;

/**
 * Description of admin
 *
 * @author Etudiant
 */
class AdminController extends Controller {
    
    public function getAdmin() {             
        $loggedUser = $this->getUser();        
        //debug($loggedUser);
        $usersModel = new UsersModel();
        $usersList = $usersModel->getAllUsers();
        $termsModel = new TermsModel();
        $termsList = $termsModel->getTerms();
        $definitionsList = $termsModel->getTerms();
        
        $this->allowTo(array('1','2'));
                      
        /*
        if ($loggedUser['usr_role'] >0) {
         * */
        $this->show('admin/admin', array(
            'usersList' => $usersList,
            'termsList' => $termsList,
            'definitionsList' => $definitionsList
        ));
        /*
        } else {
            $this->show('/default/home'); // changer a erreur 403: vous n'avez pas acces
        }
         */
    }
}

