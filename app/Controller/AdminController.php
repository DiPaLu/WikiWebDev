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

    //put your code   
    public function getAdmin() {
        $loggedUser = $this->getUser();
        $usersModel = new UsersModel();
        $usersList = $usersModel->getAllUsers();
        $termsModel = new TermsModel();
        $resultsList = $termsModel->getTerms();

        $this->show('admin/admin', array(
            'usersList' => $usersList,
            'resultsList' => $resultsList
        ));
        
    }

}
