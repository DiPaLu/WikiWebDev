<?php

namespace Controller;

/**
 * Description of LexiqueController
 *
 * @author Etudiant
 */
class LexiqueController extends \W\Controller\Controller {

	public function getTerms() {
		$this->show('lexique/lexique');
	}

}
