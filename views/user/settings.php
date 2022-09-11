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
        <div class="text-error"></div>

        <form action="/user/settings" class="formulario-account" method="POST">

            <div class="campo campo-account" id="campo_email_actual">
                <label for="email">Nuevo Email</label>
                <input type="email" id="email" name="email" value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo campo-account" id="campo_contraseña_actual">
                <label for="password">Contraseña Actual</label>
                <input type="password" id="password" name="password_actual" autocomplete="off">
            </div>
            <div class="campo campo-account" id="campo_contraseña_nueva">
                <label for="password">Nueva Contraseña</label>
                <input type="password" id="password" name="password" autocomplete="off">
            </div>
            <div class="campo campo-account" id="campo_contraseña_repetida">
                <label for="password_confirm">Repite Contraseña</label>
                <input type="password" id="password_confirm" name="password_confirm" autocomplete="off">
            </div>

            <input type="submit" value="Guardar Cambios" class="boton">

        </form>

        <form action="/" class="formulario-account" method="POST">
            <h4>¿Quieres cerrar tu cuenta?</h4>
            <p class="close-account"><span class="error">Advertencia:</span> Si cierras tu cuenta, perderas acceso permanente a éste sitio web.</p>
    
            <button class="btn-rojo" id="btn_delete">Eliminar Cuenta</button>
        </form>


    </div>
</section>
<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src="/build/js/settings.js"></script>