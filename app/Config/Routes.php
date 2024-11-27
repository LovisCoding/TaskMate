<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'ConnectionController::index');

$routes->get('/home/recap', 'HomeController::index');
$routes->get('/home/priority', 'HomeController::priority');
$routes->get('/home/state', 'HomeController::state');
$routes->get('/home/deadLine', 'HomeController::deadLine');

$routes->get('/task', 'Task::index');
$routes->get('/viewTask', 'ViewTaskController::index');

$routes->get('/auth/register', 'ConnectionController::register');
$routes->post('/auth/login', 'ConnectionController::connection');
$routes->get('/auth/forgot-password', 'ConnectionController::forgotPassword');
$routes->get('/auth/reset-password', 'ConnectionController::resetPassword');

$routes->get('/profil', 'ProfilController::index');
$routes->post('/profil/updateName', 'ProfilController::updateName');
$routes->get('/profil/resetPassword', 'ProfilController::resetPassword');
$routes->get('/profil/logout', 'ProfilController::logout');
$routes->get('/profil/deleteAccount', 'ProfilController::deleteAccount');

$routes->post('/forgot-password/sendResetLink', 'EmailController::sendResetLink');
$routes->get('/forgot-password/reset-password/(:any)', 'EmailController::resetPassword/$1');
$routes->post('/forgot-password/updatePassword','EmailController::updatePassword');

$routes->post('/email/sendConfirmAccountMail', 'EmailController::sendConfirmAccountMail');
$routes->get('/email/confirmAccount/(:any)', 'EmailController::confirmAccount/$1');