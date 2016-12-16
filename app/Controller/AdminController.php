<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\AdminModel;


/**
 * Description of admin
 *
 * @author Etudiant
 */
class AdminController extends Controller {
    //put your code here
       
    public function getAdmin() {
          //$loggedUser = $this->getUser();
          $adminModel = new AdminModel();
          $usersList = $adminModel->getAllUsers();
          $usersListUtilisateur = $adminModel->getUsersByRoleUtilisateur();
          $usersListModerateur = $adminModel->getUsersByRoleModerateur();
          $usersListAdmin = $adminModel->getUsersByRoleAdmin();

          $this->show('admin/admin', array(

              'usersList' => $usersList,
              'usersListUtilisateur' => $usersListUtilisateur,
              'usersListModerateur' => $usersListModerateur,
              'usersListAdmin' => $usersListAdmin
          ));
    }
    public function getTermsList() {
          $adminModel = new AdminModel();
          $termsList = $adminModel->getAllTerms();

          $this->show('admin/admin', array(

              'termsList' => $termsList
          ));
    }
    public function getCategoriesList() {
          $adminModel = new AdminModel();
          $categoriesList = $adminModel->getAllCategories();

          $this->show('admin/admin', array(

              'categoriesList' => $categoriesList
          ));
    }
    /*
     * public function registerAdmin(){
	//autorise l'accès à cette page seulement aux 'superadmin'
	//le tableau n'est pas nécessaire lorsqu'il n'y a qu'un rôle à spécifier
	$this->allowTo('admin');

	//reste du code...
    }
    
    public function viewAllUsers(){
	//autorise l'accès à cette page aux utilisateurs ayant le rôle 'admin' ou 'superadmin'
	//doit normalement être placé à la première ligne de chaque méthode à protéger
	$this->allowTo(['admin']);

	//reste du code...
    }
    public function editUserInfo(){
	//autorise l'accès à cette page aux utilisateurs ayant le rôle 'admin' ou 'superadmin'
	//doit normalement être placé à la première ligne de chaque méthode à protéger
	$this->allowTo('admin');

	//reste du code...
    }
    public function deleteUser(){
	//autorise l'accès à cette page aux utilisateurs ayant le rôle 'admin' ou 'superadmin'
	//doit normalement être placé à la première ligne de chaque méthode à protéger
	$this->allowTo(['admin']);

	//reste du code...
    }
    */
}