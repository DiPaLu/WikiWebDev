<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;

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
           

        $this->show('admin/admin', array(
            'usersList' => $usersList,
        ));
        
    }

}
