<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ConnectionController::index');
$routes->get('/home', 'HomeController::index');
$routes->get('/profil', 'ProfilController::index');
$routes->get('/auth/register', 'ConnectionController::register');
$routes->get('/auth/forgot-password', 'ConnectionController::forgotPassword');
$routes->get('/auth/reset-password', 'ConnectionController::resetPassword');
$routes->get('/home', 'Home::index');
$routes->get('/profil', 'Profil::index');

$routes->post('/forgot-password/sendResetLink', 'ConnectionController::sendResetLink');
$routes->get('/forgot-password/reset-password/(:any)', 'ConnectionController::resetPassword/$1');  // $1 pour capturer le token
$routes->post('/forgot-password/updatePassword','ConnectionController:updatePassword');

// Routes pour l'envoi et la confirmation de l'email
$routes->post('email/sendConfirmAccountMail', 'EmailController::sendConfirmAccountMail'); // Envoi de l'email de confirmation
$routes->get('email/confirmAccount/(:segment)', 'EmailController::confirmAccount/$1'); // Confirmation de l'activation via le token
