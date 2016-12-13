<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Login']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>

<label>Votre email</label><br/>
Adresse e-mail actuelle <input type="text" name="email" value="<?= $email; ?>"><br/>
Nouvel e-mail <input type="text" name="" value=""><br/>
<br/>
<br/>
<label>Changer votre mot de passe</label><br/>
Ancien mot de passe <input type="password" name="ancienPassword"><br/>
Nouveau mot de passe <input type="password" name="password"><br/>
Réécrire nouveau mot de passe <input type="password" name="ConfirmPassword"><br/>
<br/>
<br/>
<label>Supprimer votre compte</label><br/>
<a href="">Je veux supprimer mon compte</a><br/>
<?php
//fin du bloc
$this->stop('main_content');
?>


