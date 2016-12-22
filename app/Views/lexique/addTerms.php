<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Liste des mots']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-xs-12"> 
	  <div class="panel panel-primary">
		<div class="panel-heading">
		    <h3 class="panel-title">Proposer un nouveau mot avec sa définition</h3>
		</div>
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
		<div class="panel-body">
		    <div class="tab-content">
                        <form action="" method="post">
                            <label>Pseudo</label><br/>
                            <?= $w_user['usr_pseudo'] ?><br/><br/> 
                            <label>Mot à définir</label><br/>
                            <input name="mot" class="form_control"/><br/><br/>
                            <label>Définition</label><br/>
                            <textarea name="definition" class="form-control" rows="4"></textarea>
                            <br/>   
                            <input type="submit" class="btn" value="Envoyer"/>
                        </form>
		    </div>
		</div>
	  </div>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>
