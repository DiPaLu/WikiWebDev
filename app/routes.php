<?php
	
	$w_routes = array(
	['GET', '/', 'Default#home', 'default_home'],
	// Login
	['GET', '/login/', 'User#login', 'user_login'],
	['POST', '/login/', 'User#loginPost', 'user_login_post'],
	// Signup
	['GET', '/signup/', 'User#signup', 'user_signup'],
	['POST', '/signup/', 'User#signupPost', 'user_signup_post'],
	// Logout
	['GET', '/logout/', 'User#logout', 'user_logout'],
	//Profile
        ['GET|POST', '/profil/', 'Profil#config', 'profil_conf'],
	    
	// Page lexique global
	['GET', '/terms/', 'terms#getTerms', 'terms_getterms'],
			    
	    
	);
