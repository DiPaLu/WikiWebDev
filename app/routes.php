<?php

$w_routes = array(
    ['GET', '/', 'Terms#getTerms', 'default_home'],
    
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
    ['GET', '/changepassword/[:token]/', 'User#resetpwd', 'user_reset_pwd'],
    ['POST', '/changepassword/[:token]/', 'User#resetpwdPost', 'user_reset_pwd_post'],
    
    // Page ajout sur un mot défini
    ['GET', '/terms/add/[:termsId]/', 'Terms#getTermsAdd', 'terms_add_details'],
    // Page Terms detail
    ['GET', '/terms/[:termsId]/[:terms]/', 'Terms#getTermsDetails', 'terms_get_terms_details'],
    // Page ajout de mot et définition
    ['GET', '/terms/add/[:termsId]', 'Terms#getTermsAdd', 'terms_get_terms_add'],
    // Post pour ajout des mots et définitions dans les 2 cas de figure
    ['POST', '/terms/add/', 'Terms#getTermsAddPost', 'terms_get_terms_add_post'],
    // Page Terms global par category           
    ['GET', '/terms/[:category]', 'Terms#getTermsByCategory', 'terms_get_terms_by_category'],
    // Page Terms global            
    ['GET', '/terms/', 'Terms#getTerms', 'terms_get_terms'],
    // Page de recherche
    ['GET', '/terms/searchResult/', 'Terms#getTermsBySearch', 'terms_get_terms_by_search'],
    ['POST', '/terms/searchResult/', 'Terms#getTermsBySearchPost', 'terms_get_terms_by_search_post'],
    
    // Page admin
    ['GET', '/admin/', 'Admin#getAdmin', 'admin_get_admin'],
    //Profil
    ['GET', '/profil/parametre/', 'Profil#parametre', 'profil_parametre'],
    ['POST', '/profil/parametre/', 'Profil#parametrePost', 'profil_parametre_post'],
    ['GET|POST', '/profil/delete/', 'Profil#delete', 'profil_delete'],
    ['GET|POST', '/profil/[:pseudo]/', 'Profil#profil', 'profil_profil'],
);
