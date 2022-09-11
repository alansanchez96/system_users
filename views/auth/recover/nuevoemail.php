<section class="contenedor mensaje">
    <h1>Confirmación</h1>
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>
    <p class="<?php echo $error ? 'hidden' : ''; ?>">Tu email fue verificado y ha cambiado correctamente</p>

    <a href="/" class="btn__viewmore">Volver al inicio</a>
</section>