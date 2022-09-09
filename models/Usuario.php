<?php

namespace Model;

use Dotenv\Util\Regex;

class Usuario extends ActiveRecord
{

    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'telefono', 'dni', 'password', 'password_confirm', 'confirmado', 'token', 'picture', 'biografia', 'website', 'facebook', 'linkedin', 'password_actual', 'email_nuevo'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $dni;
    public $password;
    public $password_confirm;
    public $confirmado;
    public $token;
    public $picture;
    public $biografia;
    public $website;
    public $facebook;
    public $linkedin;
    public $password_actual;
    public $email_nuevo;

    public $regexUrl = '/(?:https?:\/\/)?(?:www\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/';
    public $regexFb = '/(?:https?:\/\/)?(?:www\.)?(mbasic.facebook|m\.facebook|facebook|fb)\.(com|me)\/(?:(?:\w\.)*#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)/';
    public $regexLinkedIn = '/(?:https?:\/\/)?(?:www\.)?linkedin\.com\/in\/[A-z0-9_-]+\/?/';

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->dni = $args['dni'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password_confirm = $args['password_confirm'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->picture = $args['picture'] ?? 'perfildefault.png';
        $this->biografia = $args['biografia'] ?? '';
        $this->website = $args['website'] ?? '';
        $this->facebook = $args['facebook'] ?? '';
        $this->linkedin = $args['linkedin'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->email_nuevo = $args['email_nuevo'] ?? '';
    }

    public function editarPerfil_validate()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El campo Nombre está vacío';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El campo Apellido está vacío';
        }
        if (!$this->dni) {
            self::$alertas['error'][] = 'El campo DNI está vacío';
        }

        return self::$alertas;
    }

    public function validarInputs()
    {
        if ($this->biografia) {
            if (strlen($this->biografia > 200)) {
                self::$alertas['error'][] = 'La biografía no debe superar los 200 caracteres';
            }
        }
        if ($this->website) {
            if (!preg_match($this->regexUrl, $this->website)) {
                self::$alertas['error'][] = 'La URL es inválida';
            }
        }
        if ($this->facebook) {
            if (!preg_match($this->regexFb, $this->facebook)) {
                self::$alertas['error'][] = 'Facebook no válido';
            }
        }
        if ($this->linkedin) {
            if (!preg_match($this->regexLinkedIn, $this->linkedin)) {
                self::$alertas['error'][] = 'LinkedIn no válido';
            }
        }


        return self::$alertas;
    }

    public function validarCuenta()
    {
        if (empty($this->nombre)) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (empty($this->apellido)) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if (!$this->dni) {
            self::$alertas['error'][] = 'El DNI es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El teléfono es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if (!$this->password_confirm) {
            self::$alertas['error'][] = 'Falta confirmar la contraseña';
        } elseif ($this->password != $this->password_confirm) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }
    public function comprobar($tipo, $mensajetipo)
    {
        if (!$this->$tipo) {
            self::$alertas['error'][] = $mensajetipo;
        }
        return self::$alertas;
    }
    public function comprobarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        return self::$alertas;
    }

    /*  */

    public function existeEmail()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }
    public function existeDni()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE dni = '" . $this->dni . "' LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }
    public function hashearPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->password_confirm = password_hash($this->password_confirm, PASSWORD_BCRYPT);
    }
    public function crearToken()
    {
        $this->token = uniqid();
    }
    public function comprobarPassword($password)
    {
        $resultado = password_verify($password, $this->password);

        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
}
