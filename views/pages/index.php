<div class="contenedor-main">
    <div class="contenedor">
        <button class="portfolio-return">
            <span class="arrow-btn"><i class='bx bx-left-arrow-alt'></i></span>
            <span class="texto-btn">Ir a portafolio</span>
        </button>
    </div>


    <div class="contenedor-credenciales">

        <div class="card-credencial">
            <h4>Credenciales</h4>
            <p><span>Email</span>: alaansannchezz@gmail.com</p>
            <p><span>DNI</span>: 40.579.092</p>
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
</div>
<script src="/build/js/main.js"></script>