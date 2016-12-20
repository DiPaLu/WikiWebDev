<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Admin']);
?>

<?php $this->start('main_content') ?>

<?php
// pour permettre d'afficher le code suivant (la liste des utilisatuers) uniqeument a l'utilisateur avec role ADMIN
if ($w_user['usr_role'] == 2) :
    ?>

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
                    
                    <!-- la liste des utilisateurs par role: utilsateurs simples-->
                    
                    <div class="col-sm-4">                                
                        <h4>Utilisateurs</h4>
                        <ul id="sortable1" class="connectedSortable">
                            <?php foreach ($usersList as $currentUser) : ?>

                                <?php if ($currentUser['usr_role'] == 0) : ?>

                                    <li class="ui-state-default"><a href="<?= $this->url('profil_profil', ['pseudo' => $currentUser['usr_pseudo']]) ?>"><?= $currentUser['usr_pseudo'] ?></a></li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- la liste des utilisateurs par role: Modérateurs-->
                    
                    <div class="col-sm-4">
                        <h4>Moderateurs</h4>
                        <ul id="sortable2" class="connectedSortable">
                            <?php foreach ($usersList as $currentUser) : ?>

                                <?php if ($currentUser['usr_role'] == 1) : ?>

                                    <li class="ui-state-default"><a href="<?= $this->url('profil_profil', ['pseudo' => $currentUser['usr_pseudo']]) ?>"><?= $currentUser['usr_pseudo'] ?></a></li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <script>
                        $(function () {
                            $("#sortable1, #sortable2").sortable({
                                connectWith: ".connectedSortable"
                            }).disableSelection();
                        });
                    </script>
                    
                    <!-- la liste des utilisateurs par role: administrateurs-->

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
if ($w_user['usr_role'] == 1) : // usr_role == 1 (role Admin)
    ?>

    <h2>Welcome: Moderator</h2>

    <p><i>Espace moderateur</i></p>

<?php endif; ?>


<!-- affiche la liste des termes a valider -->

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Nouveau termes</h3>        
    </div>


    <div class="panel-body">
        <div class="tab-content">

            <div class="row">
                <div class="col-sm-8">
                    <h4 class="panel-title"><i>Terme et définition</i></h4>
                </div>
                <div class="col-sm-1"> 
                    <i>membre</i>                  
                </div>
                <div class="col-sm-1">
                    <i>date</i>
                </div>
                
                <div class="col-sm-2">
                    <i>Action</i>
                </div>
            </div>



            <?php foreach ($termsList as $term) : ?>

                <?php if ($term['ter_status'] == 'Pending') : ?>


                    <div class="row">
                        <div class="col-sm-8">
                            <ul>
                                <li>
                                    <b><?= $term['ter_name'] ?></b><br />
                                    <?= $term['def_description'] ?>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-sm-1">  
                            <ul>
                                <li><br />
                                    pseudo
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-1">  
                            <ul>
                                <li><br />
                                    <?= $term['ter_add_date'] ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2"><br />  
                            <button type="button" class="btn btn-primary btn-sm" type="submit">Valider</button>                            
                            <button type="button" class="btn btn-primary btn-sm" type="submit">Refuser</button>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>


        </div>
    </div>
</div>
    
    <!-- Afficher la liste des demande d'ajouts de définitions supplémentaires pour termes éxistants -->

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Nouvelles définitions (pour termes existant): </h3>        
    </div>
        
    <div class="panel-body">
        <div class="tab-content">

            <div class="row">
                <div class="col-sm-8">
                    <h4 class="panel-title"><i>Définition</i></h4>
                </div>
                <div class="col-sm-2"> 
                    <i>Demandé le</i>
                </div>
                <div class="col-sm-2">
                    <i> Action</i>
                </div>
            </div>



            <?php foreach ($definitionsList as $definition) : ?>

                <?php if ($definition['def_status'] == 'Pending') : ?>


                    <div class="row">
                        <div class="col-sm-8">
                            <ul>
                                <li>
                                    <b>Def Id: <?= $definition['def_id'] ?></b><br />
                                    <?= $definition['def_description'] ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2">  
                            <ul>
                                <li><br />
                                    à faire: ajouter champ def_date_inséré dans bdd<?php// $result['ter_add_date'] ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2"><br />  
                            <button type="button" class="btn btn-primary btn-sm" type="submit">Valider</button>                            
                            <button type="button" class="btn btn-primary btn-sm" type="submit">Refuser</button>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>


        </div>
    </div>
    
</div>





<?php $this->stop('main_content') ?>