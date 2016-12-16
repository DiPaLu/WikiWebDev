<!DOCTYPE html>
<html>
   <head lang="en">
	<title><?= $this->e($title) ?></title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.min.css') ?>">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
   </head>
   <body>
	<div class="container">
	   <nav class="navbar navbar-default navbar-inverse">
		<div class="container-fluid">
		   <!-- Brand and toggle get grouped for better mobile display -->
		   <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			   <span class="sr-only">Toggle navigation</span>
			   <span class="icon-bar"></span>
			   <span class="icon-bar"></span>
			   <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= $this->url('default_home') ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
		   </div>
		   <!-- Collect the nav links, forms, and other content for toggling -->
		   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				   <li><a href="<?= $this->url('terms_get_terms') ?>">Lexique</a></li>
			    <?php if (!isset($w_user)) : ?>
				   <li><a href="<?= $this->url('user_login') ?>">Login</a></li>
				   <li><a href="<?= $this->url('user_signup') ?>">Signup</a></li>
			   <?php else : ?>
				   <li><a href="<?= $this->url('user_logout') ?>">Logout</a></li>
                                   <li><a href="<?= $this->url('profil_profil') ?>">Profil</a></li>
			   <?php endif ?>
			</ul>
		   </div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	   </nav>
	</div>
	
	<div class="container">
	   <!-- CONTENU SPÉCIFIQUE À CHAQUE PAGE ICI -->
	   <?= $this->section('main_content') ?>
	</div>
	<div class="container">
	   <footer>
		<div class="panel panel-primary">
		   <div class="panel-body text-center">&copy; Wiki Web Dev - Webforce3</div>
		</div>
	   </footer>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript" src="<?= $this->assetUrl('js/front.js') ?>"></script>
   </body>
</html>