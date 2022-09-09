<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\AuthController;
use Controllers\UserController;

$router = new Router();


$router->get('/', [AppController::class, 'index']);
$router->get('/404', [AppController::class, 'notfound']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

$router->get('/confirmacion', [AuthController::class, 'confirm']);
$router->get('/mensaje', [AuthController::class, 'message']);

$router->get('/recover/email', [AuthController::class, 'recoverEmail']);
$router->post('/recover/email', [AuthController::class, 'recoverEmail']);
$router->get('/recover/dni', [AuthController::class, 'recoverDni']);
$router->post('/recover/dni', [AuthController::class, 'recoverDni']);

$router->get('/recover/restore', [AuthController::class, 'restore']);
$router->post('/recover/restore', [AuthController::class, 'restore']);

/* USUARIOS & ADMIN */
// {Usuarios}
$router->get('/user/dashboard', [UserController::class, 'index']);

$router->get('/user/profile', [UserController::class, 'editar']);
$router->post('/user/profile', [UserController::class, 'editar']);

// Config
$router->get('/user/settings', [UserController::class, 'settings']);
$router->post('/user/settings', [UserController::class, 'settings']);
// Nuevo Email
$router->get('/user/newemail', [UserController::class, 'newEmail']);
$router->post('/user/newemail', [UserController::class, 'newEmail']);

$router->comprobarRutas();
