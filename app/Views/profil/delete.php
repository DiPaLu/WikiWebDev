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
		    <h3 class="panel-title">Lexique pour développeur</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			  <div class="row">
				<div class="col-xs-12"></div>
				<div class="col-xs-12">
				    <?php if (sizeof($errorList) > 0) : ?>
					    <?php foreach ($errorList as $currentError) : ?>
						    <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <?= $currentError ?></div>
					    <?php endforeach; ?>
				    <?php endif; ?>
				    <?php if (sizeof($successList) > 0) : ?>
					    <?php foreach ($successList as $currentSuccess) : ?>
						    <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <?= $currentSuccess ?></div>
					    <?php endforeach; ?>
				    <?php endif; ?>
				    <img class="img-rounded col-xs-2" src="<?= $this->assetUrl('img/triste.jpg'); ?>"/>
				    <div class="col-lg-12"></div>
				    <h2>Supprimer votre compte</h2>
				    <p>Vous voulez vraiment nous quitter? WikiWebDev va être triste de ne plus vous voir</p><br>
				    <form action="" method="post">
					  <label>Password</label><br/>
					  <input type="text" name="password" class="form-control" value=""><br/>
					  <input type="submit" class="btn btn-primary pull-right" value="Supprimer" />
                                          <a href="<?= $this->url('profil_parametre') ?>" class="btn btn-primary">Annuler</a>
				    </form>
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