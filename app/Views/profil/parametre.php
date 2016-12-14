<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<ul class="list-unstyled list-inline">
    <li><a href="<?= $this->url('profil_profil') ?>">Retour</a></li>
</ul>
<br/>
<label>Pseudo</label><br/>
Pseudo actuel<input type="text" class="form-control input-sm" value="<?= $pseudo; ?>"/>
Nouveau pseudo <input type="text" name="" class="form-control input-sm" value="">
<input class="pull-right btn" type="submit" value="Envoyer"/>
<br/>
<br/>
<label>Votre email</label><br/>
Adresse e-mail actuelle <input type="text" name="email" class="form-control input-sm" value="<?= $email; ?>">
Nouvel e-mail <input type="text" name="" class="form-control input-sm" value="">
<input class="pull-right btn" type="submit" value="Envoyer"/>
<br/>
<br/>
<label>Changer votre mot de passe</label><br/>
Ancien mot de passe <input type="password" class="form-control input-sm" name="ancienPassword">
Nouveau mot de passe <input type="password" class="form-control input-sm"name="password">
Réécrire nouveau mot de passe <input type="password" class="form-control input-sm" name="ConfirmPassword">
<input type="submit" class="pull-right btn" value="Envoyer" />
<br/>
<br/>
<label>Supprimer votre compte</label><br/>
<a href="<?= $this->url('profil_delete') ?>">Je veux supprimer mon compte</a><br/>
<?php
//fin du bloc
$this->stop('main_content');
?>


