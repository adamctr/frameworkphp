<?php

$router->addRoute('POST', '/login', 'AuthController#login');
$router->addRoute('POST', '/register', 'AuthController#register');
$router->addRoute('POST', '/logout', 'AuthController#logout');





