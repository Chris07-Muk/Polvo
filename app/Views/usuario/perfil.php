<!-- Importartar las depedencias -->

<?= $this->extend("plantillas/portal_base") ?>

<!-- Titulo -->
<?= $this->section('titulo') ?>
<?= $titulo_pagina ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="perfil-main">
    <div class="perfil-wrapper">
        <!-- Imagen de perfil -->
        <img src="<?= base_url(RECURSOS_PANEL_IMG_PROFILES_USER.$imagen_usuario)?>" class="perfil-img" alt="Foto de perfil">

        <!-- Nombre del usuario -->
        <h2 class="perfil-name"></h2>

        <!-- Información del usuario -->
        <div class="perfil-info">
            <p><strong>Nombre de usuario:</strong> <?=$nombre_completo?></p>
            <p><strong>Plan:</strong> <?= $nombre_plan?></p>
            <p><strong>Duración del plan:</strong> <?= $dias_activo?>  días</p>
        </div>

        <!-- Separador -->
        <div class="separator"></div>

        <!-- Botón para editar perfil -->
        <a href="<?=route_to("pagos_portal")?>" class="btn-perfil-submit">Realizar pago</a>
    </div>
</div>

<?= $this->endSection() ?>