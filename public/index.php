<?php

//autochargement des classes
require '../vendor/autoload.php';

//configuration
require '../app/config.php';

// rares fonctions globales
require '../W/globals.php';

define('__AVATAR_UPLOAD_DIR__', dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR);

//instancie notre appli en lui passant la config et les routes
$app = new W\App($w_routes, $w_config);

//exécute l'appli
$app->run();