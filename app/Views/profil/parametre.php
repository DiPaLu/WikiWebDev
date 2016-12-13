<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<ul class="list-unstyled list-inline">
    <li><a href="<?= $this->url('profil_profil') ?>">Profil</a></li>
    <li><a href="<?= $this->url('profil_parametre') ?>">Paramètres</a></li>
</ul>
<label>Votre email</label><br/>
Adresse e-mail actuelle <input type="text" name="email" value="<?= $email; ?>"><br/>
Nouvel e-mail <input type="text" name="" value=""><br/>
<input class="btn" type="submit" value="Envoyer"/>
<br/>
<br/>
<label>Changer votre mot de passe</label><br/>
Ancien mot de passe <input type="password" name="ancienPassword"><br/>
Nouveau mot de passe <input type="password" name="password"><br/>
Réécrire nouveau mot de passe <input type="password" name="ConfirmPassword"><br/>
<input type="submit" class="btn" value="Envoyer" />
<br/>
<br/>
<label>Supprimer votre compte</label><br/>
<a href="<?= $this->url('profil_delete') ?>">Je veux supprimer mon compte</a><br/>
<?php
//fin du bloc
$this->stop('main_content');
?>


