<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Admin']);
?>

<?php $this->start('main_content') ?>


	<h2>Welcome, Admin</h2>
	<p>Espace administrateur</p>
        
        
        <p>Liste des utiisateurs :
            <ul>
                <?php foreach ($usersList as $currentUser) :?>
                    <li><?= $currentUser['usr_pseudo'] ?></li>
                <?php endforeach; ?>
            </ul>

        </p>
        
	
        
        
<?php $this->stop('main_content') ?>