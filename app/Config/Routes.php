<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ConnectionController::index');
$routes->get('/home', 'HomeController::index');
$routes->get('/profil', 'ProfilController::index');
