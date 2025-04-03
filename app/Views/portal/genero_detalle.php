<?= $this->extend("plantillas/portal_base") ?>

<!-- Sección de Películas/Series del Género -->
<?= $this->section('genero') ?>
<section class="generos spad">
    <div class="container">
        <div class="section-title">
            <h4 class="text-white">Explorando: <?= esc($genero->nombre_genero) ?></h4>
        </div>

        <!-- mostrar imagenes -->
        <div class="row">
            <?php if (!empty($contenidos) && is_array($contenidos)): ?>
                <?php foreach ($contenidos as $contenido): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="contenido-card text-center p-3" style="background-color: #1b1b2f; border-radius: 8px;">
                            <a href="<?= base_url('streaming/' . $contenido->id_streaming) ?>" class="text-decoration-none">
                                <!-- Imagen fija en tamaño -->
                                <?php if (!empty($contenido->caratula_streaming)): ?>
                                    <img src="<?= base_url(RECURSOS_STREAM_IMG . esc($contenido->caratula_streaming)) ?>" 
                                        alt="<?= esc($contenido->nombre_streaming) ?>" 
                                        style="width:100%; height:320px; object-fit:cover; border-radius:6px;">
                                <?php else: ?>
                                    <img src="<?= base_url('assets/img/default-image.jpg') ?>" 
                                        alt="Imagen no disponible" 
                                        style="width:100%; height:320px; object-fit:cover; border-radius:6px;">
                                <?php endif; ?>
                                <h5 class="mt-3 text-white"><?= esc($contenido->nombre_streaming) ?></h5>
                            </a>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-light">
                    <p>No hay contenido disponible en este género.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- fin imagenes -->
    </div>
</section>
<?= $this->endSection() ?>

<!-- Título -->
<?= $this->section('titulo') ?>
    <?= esc($titulo_pagina) ?>
<?= $this->endSection() ?>
