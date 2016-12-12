<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?= $this->e($title) ?></title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    </head>
    <body>    
        <div id="maxsize">
            <div class="container">
                <nav class="navbar navbar-pills">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?= $this->url('default_home') ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                
                                <?php if (!isset($w_user)) : ?>
                                <li><a href="<?= $this->url('user_login') ?>">Login</a></li>
                                <li><a href="<?= $this->url('user_signup') ?>">Signup</a></li>
                                <?php else : ?>
                                <li><a href="<?= $this->url('user_logout') ?>">Logout</a></li>
                                <?php endif ?>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
                <section>
                    <div class="container">
                        <?= $this->section('main_content') ?>
                    </div>
                </section>
                <br /><br />
                <footer>
                    <div class="container">
                        <div class="panel panel-primary text-center">
                            &copy; DiPa - Webforce3 - 2016
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>