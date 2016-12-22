<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-xs-12">
	  <div class="panel panel-primary">
		<div class="panel-heading">
		    <h3 class="panel-title">Profil de <?= $pseudo ?></h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			  <div class="row">
				<div class="col-lg-3 col-md-3 col-sm-4">
				    <img class="img-circle" src="<?= $this->assetUrl($avatar) ?>"/>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-8">
				    <h2><?= $pseudo ?></h2>
				    <div class="">
					  <p>Pas de mots en rédaction</p>
				    </div>
				    <p>Date d'inscription : <?= $dateInscription ?></p>
				    <p>Dernière connexion: <?= $dateDerniereConnection ?></p>
				    <br/>
				    <?php if ($pseudoUtilisateur == 'yes') : ?>
					    <a href="<?= $this->url('profil_parametre') ?>">Modifier</a>
				    <?php endif; ?>
				</div>
			  </div>
		    </div>
		</div>
	  </div>
    </div>
</div>

<?php
//fin du bloc
$this->stop('main_content');
?>

