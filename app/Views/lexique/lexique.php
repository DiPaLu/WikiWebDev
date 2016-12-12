<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Login']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
   <div class="col-md-12 col-sm-8 col-xs-12">
	<div class="page-header">
	   <h1>lexique</h1>
	</div>
   </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>

