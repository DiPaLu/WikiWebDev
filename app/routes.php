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
	// Lost Password
	['GET', '/forgotpassword/', 'User#lostpwdemail', 'user_lostpwd_email'],
	['POST', '/forgotpassword/', 'User#lostpwdemailPost', 'user_lostpwd_post_email'],
	['GET', '/forgotpassword/[:toto]/', 'User#resetpwd', 'user_reset_pwd'],
	['POST', '/forgotpassword/[:toto]/', 'User#resetpwdPost', 'user_reset_pwd_post'],
	//Profile
	['GET|POST', '/profil/', 'Profil#config', 'profil_conf'],
	// Page lexique global            
	['GET', '/terms/', 'Terms#getTerms', 'terms_get_terms'],
        // Page admin
        ['GET', '/admin/', 'Admin#getAdmin', 'admin_get_admin'],
);
