<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Liste des mots']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="col-xs-2"></div>
<br>
<div class="row">
    <div class="col-xs-12">
	  <div class="panel panel-primary">
		<div class="panel-heading">
		    <h3 class="panel-title">Resultats de la recherche</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			 
			  <h3>Liste des mots :</h3>
			  <ul>
				<?php foreach ($searchResult as $result) : ?>
					<li><a href="<?= $this->url('terms_get_terms_details')?>"><?= $result['ter_name'] ?></a><br><?= $result['def_description'] ?></li><br>
				<?php endforeach; ?>
			  </ul>
		    </div>
		</div>
	  </div>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>

