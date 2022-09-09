<?php
$suscripcionSubmit = true;
$dashboard = false;
$editar = true;
$payments = false;
$certificados = false;
$courses = false;
$security = false;
$script = '<script src="/build/js/sidebar.js"></script>';
?>

<section class="account">

    <?php include_once __DIR__ . '/../templates/sidebar.php'; ?>

    <div class="account-contenido">

        <h1>Información Básica</h1>

        <div class="seccion" id="paso-1">
            <h3>Editar Perfil</h3>

            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
            <div class="text-error"></div>

            <form action="/user/profile" class="formulario-account" method="POST" enctype="multipart/form-data">
                <div class="campo campo-account" id="campo_nombre">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" placeholder="Ingresa tu nombre" value="<?php echo $usuario->nombre; ?>" name="nombre">
                </div>
                <div class="campo campo-account" id="campo_apellido">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" placeholder="Ingresa tu apellido" value="<?php echo $usuario->apellido; ?>" name="apellido">

                </div>
                <div class="campo campo-account" id="campo_dni">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" placeholder="Ej: 10.987.456" value="<?php echo $usuario->dni; ?>" name="dni">

                </div>
                <div class="campo campo-account" id="campo_biografia">
                    <label for="biografia">Biografia</label>
                    <textarea type="text" id="biografia" placeholder="200 caracteres" name="biografia"><?php echo $usuario->biografia; ?></textarea>

                </div>
                <div class="campo campo-account" id="campo_file">
                    <label for="pp">Foto de perfil</label>
                    <input type="file" id="pp" accept="image/jpeg , image/png" name="picture">
                </div>
                <div class="campo campo-account" id="campo_url">
                    <label for="pagina">URL de tu Web</label>
                    <input type="text" id="pagina" placeholder="Ej: portfolio-alansan.epizy.com/" value="<?php echo $usuario->website; ?>" name="website">
                </div>
                <div class="campo campo-account" id="campo_facebook">
                    <label for="fb">Facebook</label>
                    <input type="text" id="fb" placeholder="Ej: facebook.com/Alaansannchezz" value="<?php echo $usuario->facebook; ?>" name="facebook">
                </div>
                <div class="campo campo-account" id="campo_linkedin">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" id="linkedin" placeholder="Ej: linkedin.com/Alansanchez96" value="<?php echo $usuario->linkedin; ?>" name="linkedin">
                </div>

                <input type="submit" value="Guardar Cambios" class="boton">
            </form>
        </div>

    </div>
</section>
<script src="/build/js/profile.js"></script>