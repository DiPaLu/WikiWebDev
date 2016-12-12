<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootsrap', ['title' => 'Login']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-md-12 col-sm-8 col-xs-12">
        <div class="page-header">
            <h1>Login</h1>
        </div>

        <form action="" method="post">
            <fieldset>
                <input type="email" class="form-control" name="email" value="" placeholder="Email address" /><br />
                <input type="password" class="form-control" name="password" value="" placeholder="Your password" /><br />
                <input type="submit" class="btn btn-success btn-block" value="Login" />
            </fieldset>
        </form>
        <br />
    </div>
</div>
<?php
//fin du bloc
$this->stop('main_content');
?>

