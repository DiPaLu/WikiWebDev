<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Liste des mots']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-xs-12">
	  <div class="panel panel-primary">
		<div class="panel-heading">
		    <h3 class="panel-title">Proposer une autre définition</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			  
		    </div>
		</div>
	  </div>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>

