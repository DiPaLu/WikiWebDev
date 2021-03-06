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
    ['GET', '/terms/add/[:termsId]/', 'Terms#getTermsAdd', 'terms_get_terms_add'],
    ['POST', '/terms/add/[:termsId]/', 'Terms#getTermsAddPost', 'terms_get_terms_add_post'],
    
    //page d'ajout de mot
    ['GET', '/terms/add/', 'Terms#addTerms', 'terms_add_terms'],
    ['POST', '/terms/add/', 'Terms#addTermsPost', 'terms_add_terms_post'],
    
    // Page Terms global            
    ['GET', '/terms/', 'Terms#getTerms', 'terms_get_terms'],
    // Page Terms detail
    ['GET', '/terms/[:termsId]/[:terms]/', 'Terms#getTermsDetails', 'terms_get_terms_details'],
    
    // Page Terms global par category           
    ['GET', '/terms/[:category]/', 'Terms#getTermsByCategory', 'terms_get_terms_by_category'],
    // Page de recherche
    ['GET', '/terms/searchResult/', 'Terms#getTermsBySearch', 'terms_get_terms_by_search'],
    ['POST', '/terms/searchResult/', 'Terms#getTermsBySearchPost', 'terms_get_terms_by_search_post'],
    
    // Page admin
    ['GET', '/admin/', 'Admin#getAdmin', 'admin_get_admin'],
    ['POST', '/admin/', 'Admin#getAdminPost', 'admin_get_admin_post'],
    ['POST', '/admin/roleChange/Moderator/', 'Admin#moveToModerator', 'admin_move_to_moderator' ],
    ['POST', '/admin/roleChange/Admin/', 'Admin#moveToAdmin', 'admin_move_to_admin' ],
    ['POST', '/admin/roleChange/User/', 'Admin#moveToUser', 'admin_move_to_user' ],
    
    
    //Profil
    ['GET', '/profil/parametre/', 'Profil#parametre', 'profil_parametre'],
    ['POST', '/profil/parametre/', 'Profil#parametrePost', 'profil_parametre_post'],
    ['GET', '/profil/delete/', 'Profil#delete', 'profil_delete'],
    ['POST', '/profil/delete/', 'Profil#deletePost', 'profil_delete_post'],
    ['GET', '/profil/[:pseudo]/', 'Profil#profil', 'profil_profil'],
);
