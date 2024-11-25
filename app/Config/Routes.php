<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ConnectionController::index');
 $routes->get('/home', 'Home::index');
$routes->get('/profil', 'Profil::index');
