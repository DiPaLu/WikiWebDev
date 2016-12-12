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
	
	    
	// Page lexique global
	['GET', '/lexique/', 'lexique#getTerms', 'lexique_getterms'],
	// Page terms details
	//['GET', '/lexique/', 'lexique#getTerms', 'lexique_getterms'],
		    
	    
	);
