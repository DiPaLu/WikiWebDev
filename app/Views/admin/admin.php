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
                        <ul id="selectable">
                            <?php foreach ($usersList as $currentUser) : ?>

                                <?php if ($currentUser['usr_role'] == 0) : ?>

                                    <li class="ui-widget-content">

                                        <a href="<?= $this->url('profil_profil', ['pseudo' => $currentUser['usr_pseudo']]) ?>"><?= $currentUser['usr_pseudo'] ?></a>


                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- la liste des utilisateurs par role: Modérateurs-->

                    <div class="col-sm-4">
                        <h4>Moderateurs</h4>
                        <ul id="selectable">
                            <?php foreach ($usersList as $currentUser) : ?>

                                <?php if ($currentUser['usr_role'] == 1) : ?>

                                    <li class="ui-widget-content">
                                        <a href="<?= $this->url('profil_profil', ['pseudo' => $currentUser['usr_pseudo']]) ?>"><?= $currentUser['usr_pseudo'] ?></a>                                        
                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>



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

                <div class="row">
                    <h4>Pour modifier les permissions d'un membre, changez son role:</h4><br/>
                    
                    <div class="col-sm-4">                  
                                           
                        <label for="sel1">Membres:</label> 
                        <select class="form-control" id="select-user">
                            <option  value="0">Choose</option>

                            <?php foreach ($usersList as $currentUser) : ?>

                                <option value="<?= $currentUser['usr_id'] ?>"><?= $currentUser['usr_pseudo'] ?></option>

                            <?php endforeach; ?>                     

                        </select>
                    </div>
                    <div class="col-sm-8"></div>
                    
                </div>
                <br />
                <div class="row">                
                    
                    <div class="col-sm-12">                     
                        <button type="button" class="btn btn-warning btn-md" id="move-to-moderator">Move to Mod</button>
                    
                        <button type="button" class="btn btn-danger btn-md" id="move-to-admin">Move to Admin</button>    
                    
                        <button type="button" class="btn btn-success btn-md" id="move-to-user">Move to User</button>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <script type="text/javascript">
        
        $("#move-to-user").click(function () {

            if ($("#select-user").val() !== '' && $("#select-user").val() > 0) {

                $.ajax({
                    url: '<?= $this->url('admin_move_to_user') ?>',
                    dataType: 'json',
                    method: 'post',
                    cache: false,
                    data: {
                        id: $("#select-user").val()
                    }
                }).done(function (data) {
                    alert('L\'utilisateur ' + $("#select-user").val() + ' mis-à-jour. Rôle = utilisateur');
                });
            }    
            else {
                alert('Pas d\'utilisateur selectionné');
            }
        });
        
        $("#move-to-moderator").click(function () {

            if ($("#select-user").val() !== '' && $("#select-user").val() > 0){           

                $.ajax({
                url: '<?= $this->url('admin_move_to_moderator') ?>',
                        dataType: 'json',
                        method: 'post',
                        cache: false,
                        data: {
                        id: $("#select-user").val()
                        }
                }).done(function (data) {
                alert('L\'utilisateur ' + $("#select-user").val() + ' mis-à-jour. Rôle = modérateur');
                });
            }
            else {
                alert('Pas d\'utilisateur selectionné');
            }
        });
        
        $("#move-to-admin").click(function () {
                                   
            if ($("#select-user").val() !== '' && $("#select-user").val() > 0){ 
            
                    $.ajax({
                        url: '<?= $this->url('admin_move_to_admin') ?>',
                        dataType: 'json',
                        method: 'post',
                        cache: false,
                        data: {
                            id: $("#select-user").val()
                        }
                    }).done(function (data) {
                        alert('L\'utilisateur ' + $("#select-user").val() + ' mis-à-jour. Rôle = administrateur');                        
                    });
            }
            
            else {
                alert('Pas d\'utilisateur selectionné');
            }         
        });  
    
    </script>



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
        <h3 class="panel-title"><strong>Nouveau termes à valider:</strong> propositions d'ajouts de <strong>termes et définitions</strong> en attente de validation</h3>   
    </div>


    <div class="panel-body">
        <div class="tab-content">

            <?php foreach ($termsList as $term) : ?>

                <?php if ($term['ter_status'] == 'Pending') : ?>


                    <div class="row">
                        <div class="col-sm-7">
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
                                    <?= $term['usr_pseudo'] ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2">  
                            <ul>
                                <li><br />
                                    <?= $term['ter_add_date'] ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2"><br />
                            <form method="post" action="">
                                <input type="hidden" name="ter-id" value="<?= $term['ter_id'] ?>">
                                <input type="submit" class="btn btn-primary btn-sm" name="validate-term" value="Valider">      
                                <input type="submit" class="btn btn-warning btn-sm" name="delete-term" value="Supprimer">
                            </form>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<!-- Partie globale  -->
<!-- Afficher la liste des demande d'ajouts de définitions supplémentaires pour termes éxistants -->

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Nouvelles définitions à valider:</strong> propositions d'ajouts de <strong>définition supplémentaires</strong> pour termes déja existant</h3>        
    </div>

    <div class="panel-body">
        <div class="tab-content">         



            <?php foreach ($definitionsList as $definition) : ?>

                <?php if ($definition['def_status'] == 'Pending') : ?>


                    <div class="row">
                        <div class="col-sm-7">
                            <ul>
                                <li>
                                    <strong>Terme: <?= $definition['ter_name'] ?></strong><br />
                                    <strong>Définition: </strong>
                                    <?= $definition['def_description'] ?><br />
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-1" name="utilisateur">  
                            <ul>
                                <li><br />
                                    <?= $definition['usr_pseudo'] ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2" name="date">  
                            <ul>
                                <li><br />
                                    <?= $definition['def_add_date'] // changer!!! ajouter en BDD champe def_add_date?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-sm-2" name="action"><br/> 
                            <form method="post" action="">
                                <input type="hidden" name="def-id" value="<?= $definition['def_id'] ?>">
                                <input type="submit" class="btn btn-primary btn-sm" name="validate-definition" value="Valider">                            
                                <input type="submit" class="btn btn-warning btn-sm" name="delete-definition" value="Supprimer">
                            </form>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>



        </div>
    </div>
</div>

<?php $this->stop('main_content') ?>