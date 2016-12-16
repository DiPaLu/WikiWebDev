<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Inscription']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <h1>S'inscrire</h1>
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
        <form action="" method="post">
            <fieldset>
                <input type="text" class="form-control" name="pseudo" value="<?= $pseudo ?>" placeholder="Pseudo" /><br />
                <input type="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Adresse e-mail" /><br />
                <input type="password" class="form-control" name="password" value="" placeholder="Mot de passe" /><br />
                <input type="password" class="form-control" name="password2" value="" placeholder="Confirmation mot de passe" /><br />
                <div class="g-recaptcha" data-sitekey="6Lei_w4UAAAAAPACrDqaebbGTJ6rZsigw03lCVog"></div>
                <input type="submit" class="btn btn-success btn-block" value="S'inscrire" />
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
