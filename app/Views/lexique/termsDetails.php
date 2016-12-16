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
		    <h3 class="panel-title">Lexique pour développeur</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			  <ul>
				<?php foreach ($detailsTerms as $details) : ?>
					<li><?= $details['ter_name'] ?><br><?= $details['def_description'] ?> <a href="<?= $this->url('terms_add_details') ?>" id='proposition'>Proposer une autre définition</a></li><br>

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

