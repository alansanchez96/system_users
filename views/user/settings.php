<?php
$suscripcionSubmit = true;
$dashboard = false;
$editar = false;
$payments = false;
$certificados = false;
$courses = false;
$security = true;
$script = '<script src="/build/js/sidebar.js"></script>';
?>

<section>

    <?php include_once __DIR__ . '/../templates/sidebar.php'; ?>

    <div class="account-contenido">

        <h3>Configuracion de tu cuenta</h3>
        <h4>Seguridad</h4>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form action="/user/settings" class="formulario-account" method="POST">


            <div class="campo campo-account">
                <label for="email">Nuevo Email</label>
                <input type="email" id="email" name="email" value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo campo-account">
                <label for="password">Contraseña Actual</label>
                <input type="password" id="password" name="password_actual">
            </div>
            <div class="campo campo-account">
                <label for="password">Nueva Contraseña</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="campo campo-account">
                <label for="password_confirm">Repite Contraseña</label>
                <input type="password" id="password_confirm" name="password_confirm">
            </div>

            <input type="submit" value="Guardar Cambios" class="boton">

        </form>

        <form action="/" class="formulario-account" method="POST">
            <h4>¿Quieres cerrar tu cuenta?</h4>
            <p class="close-account"><span class="error">Advertencia:</span> Si cierras tu cuenta, perderas acceso permanente a éste sitio web.</p>
    
            <button class="btn-rojo">Eliminar Cuenta</button>
        </form>


    </div>
</section>