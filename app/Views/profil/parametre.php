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
<div class="col-lg-3">
<img class="img-circle" src="<?= $this->assetUrl('img/avatar/avatar_defaut.png'); ?>"/>
</div>
<div class="col-lg-9">
    <form action="" method="post" enctype="multipart/form-data">
        <label>Pseudo</label><br/>
        Pseudo actuel<input type="text" class="form-control input-sm" name="pseudo" value="<?= $w_user['usr_pseudo'] ?>"/>
        Modifier avatar<input type="file" name="file"/>
        <input class="pull-right btn" type="submit" value="Modifier"/>
    </form>
    <br/>
    <br/>
    <form action="" method="post">
        <label>Votre email</label><br/>
        Adresse e-mail actuelle <input type="text" name="email" class="form-control input-sm" name="email" value="<?= $w_user['usr_email'] ?>">
        <input class="pull-right btn" type="submit" value="Modifier"/>
    </form>
    <br/>
    <br/>
    <form action="" method="post">
        <label>Changer votre mot de passe</label><br/>
        Ancien mot de passe <input type="password" class="form-control input-sm" name="ancienPassword">
        Nouveau mot de passe <input type="password" class="form-control input-sm"name="password">
        Réécrire nouveau mot de passe <input type="password" class="form-control input-sm" name="ConfirmPassword">
        <input type="submit" class="pull-right btn" value="Envoyer" />
    </form>
    <br/>
    <br/>
    <label>Supprimer votre compte</label><br/>
    <a href="<?= $this->url('profil_delete') ?>">Je veux supprimer mon compte</a><br/>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>


