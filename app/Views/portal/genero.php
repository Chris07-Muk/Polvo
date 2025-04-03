<?= $this->extend("plantillas/portal_base") ?>

<!-- Título -->
<?= $this->section('titulo') ?>
    <?= esc($titulo_pagina) ?>
<?= $this->endSection() ?>

<!-- Sección de Géneros -->
<?= $this->section('genero') ?>
<section class="generos spad">
    <div class="container">
        <div class="section-title">
            <h4 class="text-white">Explora por Géneros</h4>
        </div>
        <div class="row">
            <?php if (!empty($generos) && is_array($generos)): ?>
                <?php foreach ($generos as $genero): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="genero-card text-center p-3" style="background-color: #1b1b2f; border-radius: 8px;">
                            <a href="<?= base_url('generos/' . $genero->id_genero) ?>" class="text-decoration-none">
                                <h5 class="mt-3 text-white"><?= esc($genero->nombre_genero) ?></h5>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-light">
                    <p>No hay géneros disponibles en este momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
