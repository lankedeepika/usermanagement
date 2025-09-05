<?php
// index.php

// Get the URL path (e.g., /user/profile)
$url = isset($_GET['url']) ? $_GET['url'] : '/';

// Remove trailing slash
$url = rtrim($url, '/');

// Define routes
$routes = [
    '' => 'UsersController@index',
    'login' => 'UsersController@login',
    'register' => 'UsersController@register',
    'userregister' => 'UsersController@userregister',
    'dashboard' => 'UsersController@dashboard',
    'logout' => 'UsersController@logout',
    'userverify' => 'UsersController@userverify',
    'userdelete' => 'UsersController@userdelete',
    'useradd' => 'UsersController@useradd',
    'getuserdetails' => 'UsersController@getuserdetails',
    'useredit' => 'UsersController@useredit',
    'getusers' => 'UsersController@getusers',
];

// Check if route exists
if (array_key_exists($url, $routes)) {
    list($controller, $method) = explode('@', $routes[$url]);

    require "src/Controllers/$controller.php";
    $class = "App\\Controllers\\$controller";

    $obj = new $class;
    $obj->$method();
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
}


