<?php



/*
$validateTerm = $_POST['#button-validate-term'];
$refuseTerm = $_POST['#button-refuse-term'];
$validateDefinition = $_POST['#button-validate-definition'];
$refuseDefintiion = $_POST['#button-refuse-definition'];
*/

$valTermSql= '
    UPDATE terms SET ter_status = Validated
    ';

$refTermSql= '
    UPDATE `terms` SET `ter_status`= Validated
    ';

$valDefSql= '
    UPDATE `defintion` SET `def_status`= Validated
    ';

$refDefSql= '
    UPDATE `definition` SET `def_status`= Validated
    ';


        
       
