<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Liste des mots']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<!-- Barre de recherche -->
<div class="col-xs-2"></div>
<div class="col-xs-8">
    <form role="form" method="post" action="<?= $this->url('terms_get_terms_by_search') ?>">
	  <div class="row">
		<h1 class="text-center">Barre de recherche</h1>
		<div class="form-group">
		    <div class="input-group">
			  <input class="form-control" type="text" name="search" placeholder="Rechercher" required/>
			  <span class="input-group-btn">
				<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"><span style="margin-left:10px;">Search</span></button>
			  </span>
			  </span>
		    </div>
		</div>
	  </div>
    </form>
</div>
<div class="col-xs-2"></div>
<br>
<div class="row">
    <div class="col-xs-12">
	  <div class="panel panel-primary">
		<div class="panel-heading">
		    <h3 class="panel-title">Lexique pour développeur</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			  <div class="row">
				<div class="col-xs-10">
				    <form action="" method="post" id="selectForm">
					  <div class="form-group">
						<select name="selCat" id="selCat">
						    <option value="0">Catégories</option>
						    <!-- je remplis le menu déroulant des catégories -->
						    <?php foreach ($categoryList as $catList) : ?>
							    <option value="<?php echo $catList['cat_id']; ?>"<?php echo $currentId == $catList['cat_id'] ? ' selected="selected"' : ''; ?>><?php echo $catList['cat_name']; ?>
							    </option>
						    <?php endforeach; ?>
						</select>
					  </div>
				    </form>
				    <h3>Liste des mots :</h3>
				    <ul>
					<?php foreach ($resultList as $result) : ?>
                                            <li><a href="<?= $this->url('terms_get_terms_details', array('termsId' => $result['ter_id'], 'terms' => $result['ter_name'])) ?>" class="termsFont"><?= $result['ter_name'] ?></a><br><?= $result['def_description'] ?><br>Proposé par <a href="<?= $this->url('profil_profil', ['pseudo' => $result['usr_pseudo']]) ?>"><?= $result['usr_pseudo'] ?></a> le <?= $result['ter_add_date'] ?><br>

                                            <?php if ($result['ter_tags']): ?>Tags: <?= $result['ter_tags'] ?></li>
                                            <?php endif; ?><br>
                                        <?php endforeach; ?>
				    </ul>
				</div>
				<div class="col-xs-2"></div>
			  </div>
		    </div>
		</div>
	  </div>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>
<?php $this->start('js') ?>
	<script type="text/javascript" src="<?= $this->assetUrl('js/choixPageParCategory.js') ?>"></script>
<?php $this->stop('js') ?>
