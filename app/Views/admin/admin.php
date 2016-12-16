<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Admin']);
?>

<?php $this->start('main_content') ?>


<h2>Welcome, Admin</h2>
<p><i>Espace administrateur</i></p>


<div class="container">
<h2>Liste des utiisateurs :</h2>

<div class="row">
    <div class="col-sm-4">Utilisateurs</div>
    <div class="col-sm-4">Moderateurs</div>
    <div class="col-sm-4">Admins</div>
</div>
<div class="row">
    <div class="col-sm-4">
        <ul>
            <?php foreach ($usersListUtilisateur as $currentUser) : ?>
                <li><?= $currentUser['usr_pseudo'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-sm-4">
        <ul>
            <?php foreach ($usersListModerateur as $currentUser) : ?>
                <li><?= $currentUser['usr_pseudo'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-sm-4">
        <ul>
            <?php foreach ($usersListAdmin as $currentUser) : ?>
                <li><?= $currentUser['usr_pseudo'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>



</div>

<?php $this->stop('main_content') ?>