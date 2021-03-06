<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Détail d\'un mot et ses définitions']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-xs-12">
	  <div class="panel panel-primary">
		<div class="panel-heading">
		    <h3 class="panel-title">Détail du mot <?= $detailsTerms[0]['ter_name'] ?> avec ses définitions</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			  <a href="<?= $this->url('default_home') ?>" id='proposition'>Retour</a>
			  <ul>
				<li><span class="termsFont"><?= $detailsTerms[0]['ter_name'] ?></span><br>
				<?php foreach ($detailsTerms as $details) : ?>
				<br><?= $details['def_description'] ?><br>Proposé par <a href="<?= $this->url('profil_profil', ['pseudo' => $details['usr_pseudo']]) ?>"><?= $details['usr_pseudo'] ?></a> le <?= $details['ter_add_date'] ?><br> </li><?php if ($details['ter_tags']): ?>Tags: <?= $details['ter_tags'] ?></li><br>
					<?php endif; ?><br>
				<?php endforeach; ?>

					<?php if (isset($w_user)) : ?>
				<a href="<?= $this->url('terms_get_terms_add', array('termsId'=>$details['ter_id'])) ?>" id='proposition'>Proposer une autre définition</a>
					<?php endif ?>
			  </ul>
		    </div>
		</div>
	  </div>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>
