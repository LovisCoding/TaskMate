<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'ConnectionController::index');

$routes->get('/concentration', 'ConcentrationController::index');
$routes->get('/concentration/validate', 'ConcentrationController::validateConcentration');

$routes->get('/home/recap', 'HomeController::index');
$routes->get('/home/priority', 'HomeController::priority');
$routes->get('/home/state', 'HomeController::state');
$routes->get('/home/deadLine', 'HomeController::deadLine');
$routes->post('/home/exportData', 'HomeController::exportData');

$routes->get('/task', 'Task::index');
$routes->get('/viewTask', 'ViewTaskController::index');
$routes->get('/newGroup', 'ViewGroupController::index');


$routes->get('/auth/register', 'ConnectionController::register');
$routes->post('/auth/login', 'ConnectionController::connection');
$routes->get('/auth/forgot-password', 'ConnectionController::forgotPassword');
$routes->get('/auth/reset-password', 'ConnectionController::resetPassword');

$routes->get('/profil', 'ProfilController::index');
$routes->post('/profil/updateName', 'ProfilController::updateName');
$routes->get('/profil/resetPassword', 'ProfilController::resetPassword');
$routes->get('/profil/logout', 'ProfilController::logout');
$routes->get('/profil/deleteAccount', 'ProfilController::deleteAccount');
$routes->post('/profil/updatePreferences', 'ProfilController::updatePreferences');

$routes->post('/forgot-password/sendResetLink', 'EmailController::sendResetLink');
$routes->get('/forgot-password/reset-password/(:any)', 'EmailController::resetPassword/$1');
$routes->post('/forgot-password/updatePassword','EmailController::updatePassword');

// Routes pour l'envoi et la confirmation de l'email
$routes->post('email/sendConfirmAccountMail', 'EmailController::sendConfirmAccountMail'); // Envoi de l'email de confirmation
$routes->get('email/confirmAccount/(:any)', 'EmailController::confirmAccount/$1'); // Confirmation de l'activation via le token

$routes->get('/task/insert', 'TaskController::index'); // Sans paramètre
$routes->get('/task/(:any)', 'TaskController::index/$1'); // Avec paramètre
$routes->post('/task/validate/(:any)','TaskController::validateTask/$1');
$routes->get('/api/tasks', 'APITaskController::index');

// taches
//getTaches
//createTache


// 
