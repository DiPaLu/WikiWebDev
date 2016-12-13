<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Admin']);
?>

ANTIBOOT

<?php $this->start('main_content') ?>


	<h2>Welcome, Admin</h2>
	<p>Espace administrateur</p>
	<?php var_dump($w_user); ?>
        
        
<?php $this->stop('main_content') ?>