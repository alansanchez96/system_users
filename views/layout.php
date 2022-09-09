<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
$nombre = $_SESSION['nombre'] ?? false;
$picture = $_SESSION['picture'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundo Excel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header id="header">
        <div class="barra contenedor">

            <div class="logo">
                <a href="/" class="logo">
                    <div class="logo__txt">
                        <p>System <span>Users</span></p>
                    </div>
                </a>
            </div> <!-- Fin logo -->


            <div class="log-header">

                <a href="/user/dashboard"><?php echo $nombre ? $nombre : ''; ?></a>
                <?php echo $picture
                    ? '<img src="/build/img/imagenes_usuarios/' . $usuario->picture . '" id="profilePicture">'
                    :  '<a href="/login">Login</a>
                        <a href="/register">Register</a>
                       ';
                ?>

                <div class="modal-user hidden">
                    <ul>
                        <li><a href="/user/dashboard">Ir a dashboard</a></li>
                        <li><a href="/user/profile">Editar Perfil</a></li>
                        <li><a href="/user/settings">Configuraciones</a></li>
                        <li><a href="/logout" class="logoutModal">Cerrar sesión</a></li>
                    </ul>

                </div>
            </div>

        </div> <!-- Fin barra -->
    </header>

    <?php echo $contenido; ?>

    <script src="/build/js/app.js"></script>
    <?php
    echo $script ?? '';
    ?>
</body>

</html>