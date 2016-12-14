<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Profil']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<ul class="list-unstyled list-inline">
    <li><a href="<?= $this->url('profil_parametre') ?>">Modifier</a></li>
</ul>
<h1><?= $pseudo ?></h1>
<div class="">
<p>Pas de mots en rédaction</p>
</div>
<p>Date d'inscription : <?= $date ?></p>
<p>Dernière connexion: <?= $drnConnexion ?></p>

<?php
//fin du bloc
$this->stop('main_content');
?>

