<?php 
/* 
 * routes.php
 * This file manage the modules inside the aplication
 */
/* 
 * Static Routes
 * Defined by public for all
 *
 *  Route             Method      Description
 * - "/"              GET         Home       
 * - "/n/{id}"        GET         Single post
 * - "/u/{id}"        GET         User profile
 *
 */
require '../app/controller/static.php';

/* 
 * Account
 * Used to manage user data, such as Sign in, Sign up and Sign out
 *
 *  Route             Method      Description
 * - "/s/in"          GET         Login user post
 * - "/s/in"          POST        Login user      
 * - "/s/out"         POST        Logout(if logged in with session)
 * - "/s/up"          GET         Create account post
 * - "/s/up"          POST        Create account
 * - "/u/up/{id}/u"   GET         Update user account form
 * - "/u/up/{id}/u"   POST        Update user account
 *
 */
require '../app/controller/account.php';

/* 
 * Dashboard
 * For administrative propuses to manage user posts
 *
 *  Route             Method      Description
 * - "/d"             GET         User panel
 * - "/d/add"         GET         Create post form      
 * - "/d/add"         POST        Create post
 * - "/d/n/{id}"      GET         View all post from logged user(ID in MD5)
 * - "/d/n/v/{id}"    POST        View a single post from logged user
 * - "/d/n/v/{id}/u"  GET         Update post form
 * - "/d/n/v/{id}/u"  POST        Update post
 * - "/d/n/v/{id}/d"  POST        Delete post
 */
require '../app/controller/dashboard.php';

