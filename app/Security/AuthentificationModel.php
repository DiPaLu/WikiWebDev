<?php

namespace Security;

use W\Security\StringUtils;
use \Model\UsersModel;

/**
 * Gère l'accès aux pages en fonction des droits utilisateurs
 */
class AuthentificationModel extends \W\Security\AuthentificationModel {

	public function refreshUser()
	{
		$app = getApp();
		$usersModel = new UsersModel();
		$userFromSession = $this->getLoggedUser();
		if ($userFromSession){
			$userFromDb = $usersModel->find($userFromSession[$app->getConfig('security_id_property')]);
			if($userFromDb){
				$this->logUserIn($userFromDb);
				return true;
			}
		}

		return false;
	}
}