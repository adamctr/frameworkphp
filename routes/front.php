<?php


$router->addRoute('GET', '/',  'HomepageController#execute', AuthMiddleware::class);
$router->addRoute('GET', '/login',  'AuthController#showLoginForm', '');
$router->addRoute('GET', '/register',  'AuthController#showRegisterForm', '');



