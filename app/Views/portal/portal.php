
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
            <div class="hero__items set-bg" data-setbg="<?= base_url(RECURSOS_PORTAL_IMAGES . 'blockbuster/Senior_de_los_anillos.png') ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Aventura</div>
                                <h2>El señor de los anillos</h2>
                                <p>Descripcion perrona....</p>
                                <a href="<?= route_to('genero') ?>"><span>Mira Ahora</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="<?= base_url(RECURSOS_PORTAL_IMAGES . 'blockbuster/Sonic.png') ?>">
                <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Accion</div>
                                <h2>Sonic 3: La pelicula</h2>
                                <p>A toda makina...</p>
                                <a href="<?= route_to('genero') ?>"><span>Mira Ahora</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="<?= base_url(RECURSOS_PORTAL_IMAGES .'blockbuster/Nosferatu.png')?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Suspenso</div>
                                <h2>Nosferatu</h2>
                                <p>Que miedo</p>
                                <a href="<?= route_to('genero') ?>"><span>Mira Ahora</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="streaming-section" style="padding: 4rem 2rem; background:rgb(17, 19, 78);">
    <div class="container">
        <h3 class="text-center mb-5" style="color:rgb(253, 253, 253); font-family: 'Oswald', sans-serif; font-size: 2.5rem; text-transform: uppercase;">
            Streamings Recientes
        </h3>
        <div class="row">
            <?php if (!empty($recientes)): ?>
                <?php foreach ($recientes as $stream): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div style="
                            background:rgb(11, 11, 53);
                            border-radius: 5px;
                            padding: 2rem;
                            text-align: center;
                            border: 1px solid rgba(255, 230, 0, 0.1);
                        ">
                            <img src="<?= base_url(RECURSOS_STREAM_IMG . $stream->caratula_streaming) ?>"
                                 alt="<?= esc($stream->nombre_streaming) ?>"
                                 style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;">

                            <h5 class="mt-4" style="color:rgb(255, 255, 255); font-family: 'Oswald', sans-serif; font-size: 1.3rem;">
                                <?= esc($stream->nombre_streaming) ?>
                            </h5>
                            <p class="text-light small mb-4"> Estreno: <?= esc($stream->fecha_estreno_streaming) ?></p>

                            <a href="<?= base_url('streaming/' . $stream->id_streaming) ?>" 
                               class="btn mt-2 text-white" 
                               style="background: #e53637; border-radius: 10px; font-weight: bold; padding: 10px 30px;">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-light text-center">No hay streamings recientes disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

    <!-- Hero Section End -->
<?= $this->endSection() ?>