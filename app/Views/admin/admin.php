<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Admin']);
?>

<?php $this->start('main_content') ?>


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

<!-- affiche la liste des termes a valider -->

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Termes & définitions en attente de validation</h3>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="row">


                <!-- je shoppe le code de Paul pour afficher la liste des termes -->
                <ul>
                    <?php foreach ($resultsList as $result) : ?>

                        <?php if ($result['ter_status'] == 'Pending') : ?>

                            <li>
                                <div class="col-sm-2">
                                    <?= $result['ter_name'] ?>
                                </div>
                                <div class="col-sm-8">  
                                    <?= $result['def_description'] ?>
                                </div>
                                <div class="col-sm-2">
                                    <form>
                                        <div class="col-sm-2">
                                            <label class="radio">
                                                <input type="radio" name="optradio">Valider
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="optradio">Modifier
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="optradio">Refuser
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="optradio">Garder: envoyer en bass de la liste
                                            </label>
                                            <button button type="button" class="btn btn-primary btn-sm" type="submit"><span aria-hidden="true">Confirmer</span></button>
                                        </div>
                                    </form>
                                </div>    
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>                       
            </div>
        </div>
    </div>
</div>
</div>



<?php $this->stop('main_content') ?>