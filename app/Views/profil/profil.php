<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="container">
    <div class="row">
        <ul class="list-unstyled list-inline">
            <li><a href="<?= $this->url('profil_parametre') ?>">Modifier</a></li>
        </ul>  
        <div class="col-lg-3">
            <img class="img-circle" src="<?= $this->assetUrl('img/avatar/avatar_defaut.png'); ?>"/>
        </div>
        <div class="col-lg-9">
       
        <h2><?= $w_user['usr_pseudo'] ?></h2>
        <div class="">
            <p>Pas de mots en rédaction</p>
        </div>
        <p>Date d'inscription : <?= $w_user['usr_insert_date'] ?></p>
        <p>Dernière connexion: <?= $w_user['usr_last_connected'] ?></p>
        <br/>
        </div>
        <br/>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>

