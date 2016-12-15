<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Lexique']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-sm-12">
	  <div class="page-header">
		<h3>Liste des mots :</h3>
		<p>
			<ul>
			    <?php foreach ($resultList as $result) : ?>
				    <li><?= $result['ter_name'] ?><br><?= $result['def_description'] ?></li><br>
			    <?php endforeach; ?>
			</ul>
		</p>
	  </div>
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>

