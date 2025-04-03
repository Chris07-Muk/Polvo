<?= $this->extend("plantillas/portal_base") ?>

<!-- Título -->
<?= $this->section('titulo') ?>
    <?= esc($titulo_pagina) ?>
<?= $this->endSection() ?>

<!-- Sección de Detalle del Streaming -->
<?= $this->section('stream') ?>
<section class="streaming-detalle spad">
    <div class="container">
        <div class="section-title">
            <h4 class="text-white"><?= esc($contenido->nombre_streaming) ?></h4>
            <p class="text-light">Género: <?= esc($genero->nombre_genero) ?></p>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <!-- Si hay carátula -->
                <?php if (!empty($contenido->caratula_streaming)): ?>
                    <img src="<?= base_url(RECURSOS_STREAM_IMG . esc($contenido->caratula_streaming)) ?>" 
                         alt="<?= esc($contenido->nombre_streaming) ?>" 
                         style="max-width:100%; border-radius:6px;">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/default-image.jpg') ?>" 
                         alt="Imagen no disponible" 
                         style="max-width:100%; border-radius:6px;">
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <h5 class="text-white">Detalles</h5>
                <ul class="list-unstyled text-light">
                    <li><strong>Fecha de lanzamiento:</strong> <?= esc($contenido->fecha_lanzamiento_streaming) ?></li>
                    <li><strong>Duración:</strong> <?= esc($contenido->duracion_streaming) ?></li>
                    <li><strong>Temporadas:</strong> <?= esc($contenido->temporadas_streaming) ?></li>
                    <li><strong>Clasificación:</strong> <?= esc($contenido->clasificacion_streaming) ?></li>
                    <li><strong>Estreno:</strong> <?= esc($contenido->fecha_estreno_streaming) ?></li>
                </ul>

                <h5 class="text-white">Sinopsis</h5>
                <p class="text-light"><?= esc($contenido->sipnosis_streaming) ?></p>

                <!-- Enlace al trailer si existe -->
                <?php if ($is_logged): ?>
    <?php if (!empty($ya_alquilado) && $ya_alquilado): ?>
        <a target="_blank" href="<?= route_to('ver_alquiler', esc($contenido->trailer_streaming)) ?>" class="btn btn-success">
            Ver contenido alquilado
        </a>
    <?php elseif (!empty($puede_ver_streaming) && $puede_ver_streaming): ?>
        <a target="_blank" href="<?= route_to('ver_alquiler', esc($contenido->trailer_streaming)) ?>" class="btn btn-primary">
            Alquilar streaming
        </a>
    <?php else: ?>
        <p class="text-warning">
            Ya tienes un pago activo o pendiente. Espera su validación o termina tu plan actual.
        </p>
    <?php endif; ?>
<?php else: ?>
    <p class="text-danger">Inicia sesión para alquilar contenido.</p>
<?php endif; ?>



            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
