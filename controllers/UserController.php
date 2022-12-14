<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;
use Intervention\Image\ImageManagerStatic as Image;

class UserController
{

    public static function index(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        } elseif(!$_SESSION['login']){
            header('location: /');
        }

        $id = $_SESSION['id'];
        $usuario = Usuario::find($id);

        $router->render('user/dashboard', [
            'usuario' => $usuario
        ]);
    }

    public static function editar(Router $router)
    {

        if (!isset($_SESSION)) {
            session_start();
        } elseif(!$_SESSION['login']){
            header('location: /');
        }

        $id = $_SESSION['id'];
        $usuario = Usuario::find($id);

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->editarPerfil_validate();
            $alertas = $usuario->validarInputs();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            $imgUpload = $_FILES['picture']['tmp_name'];


            if ($imgUpload) {
                $picture = Image::make($imgUpload)->fit(800, 600);
                $usuario->setImagen($nombreImagen);
            }

            if (empty($alertas)) {

                if ($imgUpload) {
                    if (!is_dir(CARPETA_IMAGENES_AUTH)) {
                        mkdir(CARPETA_IMAGENES_AUTH);
                    }
                    $picture->save(CARPETA_IMAGENES_AUTH . $nombreImagen);
                }

                $resultado = $usuario->guardar();

                if ($resultado === true) {
                    header('location: /user/dashboard');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('user/profile', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function settings(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        } elseif(!$_SESSION['login']){
            header('location: /');
        }

        $id = $_SESSION['id'];
        $usuario = Usuario::find($id);

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST); // Contiene cuando se realiza el post

            $alertas = $auth->validar('email', 'El email no puede estar vac??o');

            if (empty($alertas)) {
                // Si el mail ingresado es igual al mail del usuario
                if ($auth->email === $usuario->email) {

                    // Comprobar que la contrase??a ACTUAL sea correcta
                    if (!empty($auth->password_actual)) {
                        // Comparar la contrase??a ACTUAL con la contrase??a hash del usuario
                        $resultado = password_verify($auth->password_actual, $usuario->password);

                        if ($resultado) {
                            // Verificar que el campo NUEVA contrase??a est?? completo
                            $alertas = $auth->validar('password', 'Algunos campos est??n vac??os');
                            $alertas = $auth->securityPassword();
                            
                            if (empty($alertas)) {
                                // Verificar que la NUEVA contrase??a no sea igual a la actual
                                if ($auth->password === $auth->password_actual && $usuario->password) {
                                    $alertas = Usuario::setAlerta('error', 'La nueva contrase??a debe ser diferente a la actual');
                                } else {
                                    // Entonces si es igual, verificar que el campo repetir no est?? vacio
                                    $alertas = $auth->validar('password_confirm', 'Algunos campos est??n vac??os_confirm');

                                    if (empty($alertas)) {
                                        // Verificar que Repetir sea igual a Nuevo
                                        if ($auth->password_confirm === $auth->password) {

                                            $usuario->password = null;
                                            $usuario->password_confirm = null;
                                            $usuario->password = $auth->password;
                                            $usuario->password_confirm = $auth->password_confirm;

                                            $usuario->hashearPassword();
                                            $resultado = $usuario->guardar();

                                            if ($resultado) {
                                                header('location: /user/dashboard');
                                            }
                                        } else {
                                            $alertas = Usuario::setAlerta('error', 'Porfavor repite bien tu contrase??a');
                                        }
                                    }
                                }
                            }
                        } else {
                            $alertas = Usuario::setAlerta('error', 'La contrase??a actual no es correcta');
                        }
                    } elseif (empty($auth->password_actual)) {
                        # El campo password est?? vacio, verificar que los campos nuevoPass y confirmNuevoPass tambi??n lo est??n
                        if(!empty($auth->password)){
                            $alertas = Usuario::setAlerta('error', 'Falta ingresar la contrase??a actual');
                        } elseif(!empty($auth->password_confirm)){
                            $alertas = Usuario::setAlerta('error', 'Falta ingresar la contrase??a actual');
                        }

                    }
                } else {

                    if ($usuario->email_nuevo) {
                        if ($usuario->email_nuevo === $auth->email) {
                            $alertas = Usuario::setAlerta('error', 'El email que ingresaste ya est?? en proceso de cambio. Verifica tu correo.');
                        } else {

                            $usuario->email_nuevo = null;
                            $usuario->email_nuevo = $auth->email;

                            $usuario->crearToken();

                            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                            $email->emailChange();

                            $resultado = $usuario->guardar();
                            if ($resultado) {
                                header('location: /user/dashboard');
                            }
                        }
                    } else {
                        $usuario->email_nuevo = null;
                        $usuario->email_nuevo = $auth->email;

                        $usuario->crearToken();

                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->emailChange();

                        $resultado = $usuario->guardar();
                        if ($resultado) {
                            header('location: /user/dashboard');
                        }
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('user/settings', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function newEmail(Router $router)
    {
        $alertas = [];
        $token = '';

        if ($_GET) {
            $token = s($_GET['token']);
        } else {
            $token = '';
            header('location: /');
        }

        $error = true;

        $usuario = Usuario::where('token', $token);

        if (empty($usuario) || $usuario->token === '') {
            header('location: /');
        } elseif ($usuario->token !== $usuario->token) {
            header('location: /');
        } else {
            $error = false;

            $usuario->token = '' ?? null;
            $usuario->email = '' ?? null;
            $usuario->email = $usuario->email_nuevo;
            $usuario->email_nuevo = '' ?? null;

            $resultado = $usuario->guardar();
            if ($resultado) {
                Usuario::setAlerta('exito', 'El email ha sido cambiado correctamente');
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/recover/nuevoemail', [
            'alertas' => $alertas,
            'error' => $error,
            'usuario' => $usuario
        ]);
    }
}
