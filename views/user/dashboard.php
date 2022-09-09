<?php
$suscripcionSubmit = true;
$dashboard = true;
$editar = false;
$payments = false;
$certificados = false;
$courses = false;
$security = false;
$script = '<script src="/build/js/sidebar.js"></script>';
?>
<section class="account">

    <?php include_once __DIR__ . '/../templates/sidebar.php'; ?>

    <div class="dashboard">

        <div class="dashboard__head"></div>
        <div class="dashboard__body">

            <div class="dashboard_imagen-perfil">
                <img src="<?php echo $usuario->picture ? '/build/img/imagenes_usuarios/' . $usuario->picture : '/build/img/imagenes_usuarios/perfildefault.png'; ?>" alt="">
            </div>

            <h1>¡Bienvenido <span><?php echo $usuario->nombre . ' ' . $usuario->apellido; ?></span>!</h1>
            <h1>Añadir FetchAPI a los formularios</h1>
            <h1>Finalizar home</h1>

            <div class="cards">
                <div class="card" id="card_editarPerfil">
                    <div class="contenido_card">
                        <span class="arrow"><i class='bx bx-right-arrow-alt'></i></span>
                        <span class="card_text">
                            <h4>Editar Perfil</h4>
                        </span>
                    </div>
                </div>
                <div class="card" id="card_configuracion">
                    <div class="contenido_card">
                        <span class="arrow"><i class='bx bx-right-arrow-alt'></i></span>
                        <span class="card_text">
                            <h4>Configuraciones</h4>
                        </span>
                    </div>
                </div>
            </div>

            <div class="dashboard__contenido contenedor">
                <div class="dashboard__contenido-biografia">
                    <h4>Un poco sobre mi</h4>
                    <p><?php echo $usuario->biografia ? $usuario->biografia : 'El usuario ' . $usuario->nombre . ' aún no ha escrito nada...'; ?></p>
                </div>
                <div class="dashboard_contenido-redes">
                    <h4>Mis redes sociales</h4>
                    <?php
                    if ($usuario->website) { ?>
                        <a href="<?php echo $usuario->website; ?>">
                            <p><span class="span_redes">Website:</span> <?php echo $usuario->website; ?></p>
                        </a>
                        <?php
                        if ($usuario->facebook) { ?>
                            <a href="<?php echo $usuario->facebook; ?>">
                                <p><span class="span_redes">Facebook</span>: <?php echo $usuario->facebook; ?></p>
                            </a>
                        <?php }
                        if ($usuario->linkedin) { ?>
                            <a href="<?php echo $usuario->linkedin; ?>">
                                <p><span class="span_redes">LinkedIn</span>: <?php echo $usuario->linkedin; ?></p>
                            </a>
                        <?php }
                    } elseif ($usuario->facebook) {
                        if ($usuario->website) { ?>
                            <a href="<?php echo $usuario->website; ?>">
                                <p><span class="span_redes">Website:</span> <?php echo $usuario->website; ?></p>
                            </a>
                        <?php } ?>
                        <a href="<?php echo $usuario->facebook; ?>">
                            <p><span class="span_redes">Facebook</span>: <?php echo $usuario->facebook; ?></p>
                        </a>
                        <?php
                        if ($usuario->linkedin) { ?>
                            <a href="<?php echo $usuario->linkedin; ?>">
                                <p><span class="span_redes">LinkedIn</span>: <?php $usuario->linkedin; ?></p>
                            </a>
                        <?php }
                    } elseif ($usuario->linkedin) {
                        if ($usuario->website) { ?>
                            <a href="<?php echo $usuario->website; ?>">
                                <p><span class="span_redes">Website:</span> <?php echo $usuario->website; ?></p>
                            </a>
                        <?php }
                        if ($usuario->facebook) { ?>
                            <a href="<?php echo $usuario->facebook; ?>">
                                <p><span class="span_redes">Facebook</span>: <?php echo $usuario->facebook; ?></p>
                            </a>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="dashboard_text-redes">El usuario aún no ha publicado sus redes sociales <i class='bx bx-sad'></i></p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>


    </div> <!-- Contenido -->
</section>
<script src="/build/js/dashboard.js"></script>