<?php

$w_routes = array(
	['GET', '/', 'Terms#getTerms', 'default_home'],
	//['GET', '/', 'Default#home', 'default_home'],
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
	['GET', '/forgotpassword/[:token]/', 'User#resetpwd', 'user_reset_pwd'],
	['POST', '/forgotpassword/[:token]/', 'User#resetpwdPost', 'user_reset_pwd_post'],
	// Page lexique global            
	['GET', '/terms/', 'Terms#getTerms', 'terms_get_terms'],
	['GET', '/terms/[:id]/[:mot]/', 'Terms#getTermsDetails', 'terms_get_terms_details'],
        // Page ajout de mot et définition
	['GET', '/terms/add/', 'Terms#getTermsAdd', 'terms_get_terms_add'],
        // Page ajout sur un mot défini
	['GET', '/terms/add/[:id]/', 'Terms#getTermsAdd', 'terms_add_details'],
        // Post pour ajout des mots et définitions dans les 2 cas de figure
	['POST', '/terms/add/', 'Terms#getTermsAddPost', 'terms_get_terms_add_post'],
        // Page admin
        ['GET', '/admin/', 'Admin#getAdmin', 'admin_get_admin'],
        //Profile
	['GET|POST', '/profil/parametre/', 'Profil#parametre', 'profil_parametre'],
        ['GET|POST', '/profil/delete/', 'Profil#delete', 'profil_delete'],
        ['GET|POST', '/profil/[:pseudo]/', 'Profil#profil', 'profil_profil'],
        ['GET|POST', '/profil/update', 'Profil#update', 'update_profil'],
);
