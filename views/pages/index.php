<div class="contenedor-main">
    <div class="contenedor">
        <button class="portfolio-return" id="portfolioReturn">
            <span class="arrow-btn"><i class='bx bx-left-arrow-alt'></i></span>
            <span class="texto-btn">Ir a portafolio</span>
        </button>
    </div>


    <div class="contenedor-info">

        <div class="card-credencial">
            <h4>Credenciales</h4>
            <p><span>Email</span>: alaansannchezz@gmail.com</p>
            <p><span>DNI</span>: 10.987.456</p>
            <p><span>Contraseña</span>: Contraseña1</p>
        </div>

    </div>
    <?php
    if (!$usuario) { ?>
        <div class="container">
            <div class="cards">
                <div class="card card-one" id="cardLog">
                    <h2 class="card-title">Log In</h2>
                </div>

                <div class="card card-two" id="cardRegister">
                    <h2 class="card-title">Register</h2>
                </div>
            </div>
        </div>

    <?php } else { ?>
        <div class="container">

            <div class="cards">
                <div class="card card-one" id="cardDashboard">
                    <h2 class="card-title">Ir a dashboard</h2>
                </div>
            </div>
        </div>
    <?php }; ?>

    <div class="contenedor-info">

        <div class="card-credencial">
            <h4>Lenguajes utilizados</h4>
            <p><span>PHP 8 puro</span></p>
            <p><span>SCSS</span></p>
            <p><span>JavaScript puro</span></p>
            <p><span>MySQL</span></p>
            <p><span>Npm & Composer</span></p>
            <p><span>Gulp Sass</span></p>
            <p><span>PHPMailer</span></p>
            <button class="repositorio" id="repositorio">
                <span class="arrow-btn"><i class='bx bx-right-arrow-alt'></i></span>
                <span class="texto-btn">Repositorio en Github</span>
            </button>
        </div>

    </div>
</div>
<footer>
    <p><a href="https://linkedin.com/in/alansanchez96" target="_blank">Alan Sanchez</a> &copy; Todos los derechos reservados</p>
</footer>
<script src="/build/js/main.js"></script>