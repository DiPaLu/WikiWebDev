<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="col-lg-6">
<img class="img-rounded col-lg-2" src="<?= $this->assetUrl('img/triste.jpg'); ?>"/>
<h2>Supprimer votre compte</h2>
<p>Vous voulez vraiment nous quitter? WikiWebDev va être triste de ne plus vous voir</p>
<label>Password</label><br/>
<input type="text" name="" class="form-control" value=""><br/>
<input type="submit" class="btn pull-left" value="Supprimer" />
<input type="submit" class="btn pull-right" value="Annuler" />
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>