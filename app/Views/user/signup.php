<?php
//hérite du fichier layout.php à la racine de app/Views/default/
$this->layout('layoutBootstrap', ['title' => 'Inscription']);
?>
<?php
// Début du bloc d'affichage
$this->start('main_content');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">S'inscrire</h3>
            </div>
            <div class="panel-body">
                <div class="tab-content">
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
                    <form id="signup" action="" method="post">
                        <fieldset>
                            <input type="text" class="form-control" name="pseudo" value="<?= $pseudo ?>" placeholder="Pseudo" /><br />
                            <input type="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Adresse e-mail" /><br />
                            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Mot de passe" /><br />
                            <input id="password2" type="password" class="form-control" name="password2" value="" placeholder="Confirmation mot de passe" /><br />
                            <label style="display: block; text-align: center" >Afficher / Cacher mot de passe<input type="checkbox" class="form-control" id="showpwd" /></label>
                            <div class="g-recaptcha" data-sitekey="6Lei_w4UAAAAAPACrDqaebbGTJ6rZsigw03lCVog" data-theme="dark"></div><br />
                            <input type="submit" class="btn btn-success btn-block" value="S'inscrire" />
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-0"></div>
            </div>
        </div>
    </div>
</div>
<br /><br />

<?php
//fin du bloc
$this->stop('main_content');
?>
