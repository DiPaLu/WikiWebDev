<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="col-lg-6">
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
<img class="img-rounded col-lg-2" src="<?= $this->assetUrl('img/triste.jpg'); ?>"/>
<h2>Supprimer votre compte</h2>
<p>Vous voulez vraiment nous quitter? WikiWebDev va être triste de ne plus vous voir</p>
<form action="" method="post">
    <label>Password</label><br/>
    <input type="password" name="password" class="form-control" value=""><br/>
    <input type="submit" class="btn pull-right" value="Supprimer" />
</form>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>