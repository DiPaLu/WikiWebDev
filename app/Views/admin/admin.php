<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Admin']);
?>

<?php $this->start('main_content') ?>

<?php
// pour permettre d'afficher le code suivant (la liste des utilisatuers) uniqeument a l'utilisateur avec role ADMIN
if ($w_user['usr_role'] == 2) : ?>

<h2>Welcome: Admin</h2>

<p><i>Espace administrateur</i></p>
<!-- affiche la liste des utilisateurs (clickable) dans troi colonnes, par role: utilsateur, moderateur, admin -->

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Liste des utiisateurs</h3>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Utilisateurs</h4>
                    <ul>
                        <?php foreach ($usersList as $currentUser) : ?>

                            <?php if ($currentUser['usr_role'] == 0) : ?>

                                <li><a href="<?= $this->url('profil_profil', ['pseudo' => $currentUser['usr_pseudo']]) ?>"><?= $currentUser['usr_pseudo'] ?></a></li>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h4>Moderateurs</h4>
                    <ul>
                        <?php foreach ($usersList as $currentUser) : ?>

                            <?php if ($currentUser['usr_role'] == 1) : ?>

                                <li><a href="<?= $this->url('profil_profil', ['pseudo' => $currentUser['usr_pseudo']]) ?>"><?= $currentUser['usr_pseudo'] ?></a></li>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h4>Admins</h4>
                    <ul>
                        <?php foreach ($usersList as $currentUser) : ?>

                            <?php if ($currentUser['usr_role'] == 2) : ?>

                                <li><a href="<?= $this->url('profil_profil', ['pseudo' => $currentUser['usr_pseudo']]) ?>"><?= $currentUser['usr_pseudo'] ?></a></li>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php
// pour permettre d'afficher le code suivant (la liste des utilisatuers) uniqeument a l'utilisateur avec role ADMIN
if ($w_user['usr_role'] == 1) : ?>

<h2>Welcome: Moderator</h2>

<p><i>Espace moderateur</i></p>

<?php endif; ?>


<!-- affiche la liste des termes a valider -->

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Termes & définitions en attente de validation</h3>        
    </div>
                  
    
    <div class="panel-body">
        <div class="tab-content">
            
             <div class="row">
                        <div class="col-sm-8">
                            <h4 class="panel-title">Terme et définition à ajouter</h4>
                        </div>
                        <div class="col-sm-2"> 
                            Demandé le
                        </div>
                        <div class="col-sm-2">
                            Action
                        </div>
                    </div>



            <?php foreach ($resultsList as $result) : ?>

                <?php if ($result['ter_status'] == 'Pending') : ?>

                   
                    <div class="row">
                        <div class="col-sm-8">
                            <ul>
                                <li>
                                    <b><?= $result['ter_name'] ?></b><br />
                                    <?= $result['def_description'] ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2">  
                            <ul>
                                <li><br />
                                    <?= $result['ter_add_date'] ?>
                                </li>
                            </ul>
                        </div>


                        <div class="col-sm-2"><br />  

                            <button type="button" class="btn btn-primary btn-sm" type="submit"><span aria-hidden="true">Oui</span></button>                            
                            <button type="button" class="btn btn-primary btn-sm" type="submit"><span aria-hidden="true">Non</span></button>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>


        </div>
    </div>
</div>



<?php $this->stop('main_content') ?>