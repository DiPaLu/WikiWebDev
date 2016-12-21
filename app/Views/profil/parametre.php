<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
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


<div class="col-lg-3">
    <form action="" method="post" enctype="multipart/form-data"/>
        <label>Avatar</label><br/>
        <input type="file" name="file"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="1"/>
        <p class="help-block">extentions autorisées: .png, .jpeg, .jpg </p>
    <br/>
    <img class="img-circle" src="<?= $this->assetUrl('img/avatar/avatar_defaut.png'); ?>"/>
</div>
<div class="col-lg-9">
    <form action="" method="post">
        <label>Pseudo</label><br/>
        Pseudo actuel<input type="text" class="form-control input-sm" name="pseudo" value="<?= $w_user['usr_pseudo'] ?>"/>
        <input type="submit" class="pull-right btn" value="Modifier" />
        <br/>
    </form>
    <br/>
    <br/>
    <form action="" method="post">
        <label>Votre email</label><br/>
        Adresse e-mail actuelle <input type="text" name="email" class="form-control input-sm" name="email" value="<?= $w_user['usr_email'] ?>">
        <input type="submit" class="pull-right btn" value="Modifier" />
    </form>
    <br/>
    <br/>
    <form action="" method="post">
        <label>Changer votre mot de passe</label><br/>
        Ancien mot de passe <input type="password" class="form-control input-sm" name="ancienPassword">
        Nouveau mot de passe <input type="password" class="form-control input-sm"name="password">
        Réécrire nouveau mot de passe <input type="password" class="form-control input-sm" name="ConfirmPassword">
        <input type="submit" class="pull-right btn" value="Modifier" />
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


