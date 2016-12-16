<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Admin']);
?>

<?php $this->start('main_content') ?>


<h2>Welcome: Admin</h2>
<p><i>Espace administrateur</i></p>



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






<?php $this->stop('main_content') ?>