<!-- Importartar las depedencias -->

<?= $this->extend("plantillas/portal_base") ?>

<!-- Titulo -->
<?= $this->section('titulo') ?>
    <?= $titulo_pagina ?>
<?= $this->endSection() ?>


<?= $this->section('carrusel') ?>
<!-- Hero Section Begin -->
<section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="<?= base_url(RECURSOS_PORTAL_IMAGES . 'blockbuster/Minecraft.png') ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Live Action</div>
                                <h2>MINECRAFT</h2>
                                <p>La aventura perdida...</p>
                                <a href="<?= route_to('genero') ?>"><span>Mira Ahora</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="<?= base_url(RECURSOS_PORTAL_IMAGES . 'blockbuster/Thor.png') ?>">
                <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Accion</div>
                                <h2>THOR: LOVE AND TUNDER</h2>
                                <p>la isla perdida...</p>
                                <a href="<?= route_to('genero') ?>"><span>Mira Ahora</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="<?= base_url(RECURSOS_PORTAL_IMAGES .'blockbuster/american.png')?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Suspenso</div>
                                <h2>AMERICAN PSYSCHO</h2>
                                <p>Recordando los clasicos...</p>
                                <a href="<?= route_to('genero') ?>"><span>Mira Ahora</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
<?= $this->endSection() ?>



