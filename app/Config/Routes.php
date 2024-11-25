<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ConnectionController::index');
$routes->get('/auth/register', 'ConnectionController::register');
$routes->get('/auth/forgot-password', 'ConnectionController::forgotPassword');
$routes->get('/auth/reset-password', 'ConnectionController::resetPassword');
$routes->get('/home', 'Home::index');
$routes->get('/profil', 'Profil::index');
