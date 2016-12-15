<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Login']);
?>

<?php $this->start('main_content') ?>
<section>
    <p>WikiWebDev est une superbe et ingénieuse application permettant de rechercher des mots et des définitions pour les developpeurs</p>
<br/>
<br/>
        <form action="" method='post'>
            <input type="text" class="searchInput" placeholder="Mots, définitions">
            <input type="submit" class="searchSubmit" value="Rechercher">
        </form>
</section>
    <h2>Mot du jour</h2>
	
<?php $this->stop('main_content') ?>
