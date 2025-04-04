<?= $this->extend("plantillas/portal_base") ?>

<!-- Título -->
<?= $this->section('titulo') ?>
    <?= esc($titulo_pagina) ?>
<?= $this->endSection() ?>



<?= $this->section('login') ?>

    

    <!-- Breadcrumb -->
    <section class="normal-breadcrumb set-bg" data-setbg="<?= RECURSOS_USUARIO_IMG ?>/Banner.png" 
    style="background-size: cover; background-position: center; background-repeat: no-repeat; height: 50vh;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        
                        <!-- <p>Bienvenido a BlockBuster</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Section -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <!-- Login Form -->
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Inicio de Sesion</h3>
                        <?= form_open('iniciar_sesion', ['id' => 'form-login']) ?>

                        <div class="input__item">
                            <?= form_input([
                                'type' => 'email',
                                'name' => 'correo_electronico',
                                'placeholder' => 'Correo electronico',
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                            <span class="icon_mail"></span>
                        </div>

                        <div class="input__item">
                            <?= form_input([
                                'type' => 'password',
                                'name' => 'pass',
                                'placeholder' => 'Contraseña',
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                            <span class="icon_lock"></span>
                        </div>

                        <?= form_submit('btn-submit', 'Entra Ahora', ['class' => 'site-btn']) ?>

                        <?= form_close() ?>

                        <a href="#" class="forget_pass">  ¿Olvidaste tu contraseña?</a>
                        
                    </div>
                </div>

                <!-- Register Prompt -->
                <div class="col-lg-6">
                    <div class="login__register text-center">
                        <h3>¿No tienes una cuenta?</h3>
                        <a href="<?= base_url('registro') ?>" class="primary-btn">Registrate Ya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Search Modal -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="<?= RECURSOS_USUARIO_JS ?>/jquery-3.3.1.min.js"></script>
    <script src="<?= RECURSOS_USUARIO_JS ?>/bootstrap.min.js"></script>
    <script src="<?= RECURSOS_USUARIO_JS ?>/player.js"></script>
    <script src="<?= RECURSOS_USUARIO_JS ?>/jquery.nice-select.min.js"></script>
    <script src="<?= RECURSOS_USUARIO_JS ?>/mixitup.min.js"></script>
    <script src="<?= RECURSOS_USUARIO_JS ?>/jquery.slicknav.js"></script>
    <script src="<?= RECURSOS_USUARIO_JS ?>/owl.carousel.min.js"></script>
    <script src="<?= RECURSOS_USUARIO_JS ?>/main.js"></script>
    <script src="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS . '/toastr/toastr.min.js') ?>"></script>
    <script><?= show_message() ?></script>
</body>
</html>
<?= $this->endSection() ?>