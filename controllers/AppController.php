<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class AppController
{

    public static function index(Router $router)
    {

        if (!isset($_SESSION)) {
            session_start();
        }
        if ($_SESSION) {
            $id = $_SESSION['id'];
            $usuario = Usuario::find($id);
        } else {
            $usuario = '';
        }

        $router->render('pages/index', [
            'usuario' => $usuario
        ]);

        $router->render('pages/index');
    }

    public static function notfound(Router $router)
    {

        $router->render404();
    }
}
