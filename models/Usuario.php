<?php

namespace Model;

use Dotenv\Util\Regex;

class Usuario extends ActiveRecord
{

    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'dni', 'password', 'password_confirm', 'confirmado', 'token', 'picture', 'biografia', 'website', 'facebook', 'linkedin', 'password_actual', 'email_nuevo'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
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

    public $regexNames = '/^[a-zA-ZÀ-ÿ\s]{1,40}$/';
    public $regexDni = '/^\d{1,2}\.?\d{3}\.?\d{3}$/';
    public $regexWebsite = '/(?:https?:\/\/)?(?:www\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/';
    public $regexFb = '/(?:https?:\/\/)?(?:www\.)?(mbasic.facebook|m\.facebook|facebook|fb)\.(com|me)\/(?:(?:\w\.)*#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)/';
    public $regexLinkedIn = '/(?:https?:\/\/)?(?:www\.)?linkedin\.com\/in\/[A-z0-9_-]+\/?/';

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
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
        } elseif ($this->nombre) {
            if (!preg_match($this->regexNames, $this->nombre)) {
                self::$alertas['error'][] = 'El nombre contiene caracteres inválidos';
            }
        }

        if (!$this->apellido) {
            self::$alertas['error'][] = 'El campo Apellido está vacío';
        } elseif ($this->apellido) {
            if (!preg_match($this->regexNames, $this->apellido)) {
                self::$alertas['error'][] = 'El apellido contiene caracteres inválidos';
            }
        }

        if (!$this->dni) {
            self::$alertas['error'][] = 'El campo DNI está vacío';
        } elseif ($this->dni) {
            if (!preg_match($this->regexDni, $this->dni)) {
                self::$alertas['error'][] = 'El formato DNI no es válido';
            }
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
            if (!preg_match($this->regexWebsite, $this->website)) {
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
        if ($this->picture) {

            if (!is_null($_FILES['name'])) {
                if ($_FILES['picture']['type'] != 'image/jpeg' and $_FILES['picture']['type'] != 'image/png') {
                    self::$alertas['error'][] = 'Formato de imagen no válido';
                }
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
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        // Comparacion de contraseña
        if (!$this->password_confirm) {
            self::$alertas['error'][] = 'Falta confirmar la contraseña';
        } elseif ($this->password != $this->password_confirm) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }
    public function securityPassword()
    {
        // Entre 6 y 16 ; Letra Mayus y Minus ; 1 Caracter numerico
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "La clave debe tener al menos 6 caracteres";
        } elseif (strlen($this->password) > 16) {
            self::$alertas['error'][] = "La clave no puede tener más de 16 caracteres";
        } elseif (!preg_match('`[a-z]`', $this->password)) {
            self::$alertas['error'][] = "La clave debe tener al menos una letra minúscula";
        } elseif (!preg_match('`[A-Z]`', $this->password)) {
            self::$alertas['error'][] = "La clave debe tener al menos una letra mayúscula";
        } elseif (!preg_match('`[0-9]`', $this->password)) {
            self::$alertas['error'][] = "La clave debe tener al menos un caracter numérico";
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
