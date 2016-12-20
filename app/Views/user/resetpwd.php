<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Change password']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-md-12 col-sm-8 col-xs-12">
        <div class="page-header">
            <h1>Change password</h1>
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
        <form id="changepwd" action="" method="post">
            <fieldset>
                <input type="password" class="form-control" name="password" value="" placeholder="Your new password" /><br />
                <input type="password" class="form-control" name="password2" value="" placeholder="Confirm your new password" /><br />
                <input type="submit" class="btn btn-success btn-block" value="Change password" />
            </fieldset>
        </form>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-0"></div>
</div>
<br /><br />

<?php
//fin du bloc
$this->stop('main_content');
?>
