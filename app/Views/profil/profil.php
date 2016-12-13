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
<button>Modifier</button>
<h1><?= $email ?></h1>
<p>Pas de mots en rédaction</p>
<p>Date d'inscription : <?= $date ?></p>
<p>Dernière connexion: <?= $drnConnexion ?></p>

<?php
//fin du bloc
$this->stop('main_content');
?>

