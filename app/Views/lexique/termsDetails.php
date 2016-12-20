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
		    <h3 class="panel-title">Lexique pour développeur</h3>
		</div>
		<div class="panel-body">
		    <div class="tab-content">
			  <ul>
				<?php foreach ($detailsTerms as $details) : ?>
				<li><span class="termsFont"><?= $details['ter_name'] ?></span><br><?= $details['def_description'] ?> </li><?php if ($details['ter_tags']): ?>Tags: <?= $details['ter_tags'] ?></li>
					<?php endif; ?><br><br>
                                <?php endforeach; ?>
				<a href="<?= $this->url('terms_add_details', array('termsId'=>$details['ter_id'])) ?>" id='proposition'>Proposer une autre définition</a>
                                
                                
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
