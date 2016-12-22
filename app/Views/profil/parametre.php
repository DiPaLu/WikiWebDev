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
		    <h3 class="panel-title">Profil à éditer</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
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
			  <ul class="list-unstyled list-inline pull-right">
				<li><a href="<?= $this->url('profil_profil') ?>">Afficher</a></li>
			  </ul>
                        <form action="" method="post" enctype="multipart/form-data"/>
                                <label>Avatar</label><br/>
                                <input type="file" name="file"/>
                                <input type="hidden" name="MAX_FILE_SIZE" value="1"/>
                                <p class="help-block">extentions autorisées: .png, .jpeg, .jpg et .gif </p>
                                <img class="img-circle" src="<?= $this->assetUrl($w_user['usr_avatar'] ); ?>"/>
                                <input type="submit" class="pull-right btn" value="Modifier"/>
                                <br/>
                                
				<br/>
			  </form>
                            <form action="" method=post"">
                                <label>Pseudo</label><br/>
				Pseudo actuel<input type="text" class="form-control input-sm" name="pseudo" value="<?= $w_user['usr_pseudo'] ?>"/>
                                <input type="hidden" name='pseudoFormulaire' value='1'/>
				<input type="submit" class="pull-right btn" value="Modifier" />
                            </form>
			  <br/>
			  <br/>
			  <form action="" method="post">
				<label>Votre email</label><br/>
				Adresse e-mail actuelle <input type="text" name="email" class="form-control input-sm" name="email" value="<?= $w_user['usr_email'] ?>">
                                <input type="hidden" name='emailFormulaire' value='1'/>
				<input type="submit" class="pull-right btn" value="Modifier" />
			  </form>
			  <br/>
			  <br/>
			  <form action="" method="post">
				<label>Changer votre mot de passe</label><br/>
				Ancien mot de passe <input type="password" class="form-control input-sm" name="ancienPassword">
				Nouveau mot de passe <input type="password" class="form-control input-sm"name="password">
				Réécrire nouveau mot de passe <input type="password" class="form-control input-sm" name="confirmPassword">
                                <input type="hidden" name='passwordFormulaire' value='1'/>
				<input type="submit" class="pull-right btn" value="Modifier" />
			  </form>
			  <br/>
			  <br/>
			  <label>Supprimer votre compte</label><br/>
			  <a href="<?= $this->url('profil_delete') ?>">Je veux supprimer mon compte</a><br/>
		    </div>
		</div>
	  </div>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>


