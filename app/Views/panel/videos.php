<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F9FAFB;
        color: #111827;
    }

    h4 {
        font-weight: 600;
        color: #4F46E5;
    }

    .btn-agregar {
        background-color: #4F46E5;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-agregar:hover {
        background-color: #4338CA;
        color: white;
        transform: translateY(-1px);
    }

    .form-inline label {
        font-weight: 500;
        margin-right: 10px;
        color: #374151;
    }

    .form-inline select {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 6px 12px;
    }

    .table th {
        background-color: #4F46E5;
        color: white;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background-color: #EEF2FF;
    }

    .btn-sm {
        border-radius: 6px;
        padding: 6px 10px;
        color: white;
        margin: 2px;
    }

    .btn-warning {
        background-color: #F59E0B;
        border: none;
    }

    .btn-warning:hover {
        background-color: #D97706;
    }

    .btn-success {
        background-color: #10B981;
        border: none;
    }

    .btn-success:hover {
        background-color: #059669;
    }

    .btn-info {
        background-color: #06b6d4;
        border: none;
    }

    .btn-info:hover {
        background-color: #0891b2;
    }

    .btn-danger {
        background-color: #EF4444;
        border: none;
    }

    .btn-danger:hover {
        background-color: #DC2626;
    }

    .badge-success {
        background-color: #10B981;
        padding: 5px 10px;
        border-radius: 8px;
        color: white;
    }

    .badge-danger {
        background-color: #EF4444;
        padding: 5px 10px;
        border-radius: 8px;
        color: white;
    }

    video {
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Listado de Videos</h4>

        <!-- BOTÓN AGREGAR VIDEO -->
        <a href="<?= route_to('nuevo_video') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus"></i> Nuevo Video
        </a>

        <!-- FILTRO POR STREAMING -->
        <form method="get" action="<?= route_to('videos') ?>" class="form-inline mb-3">
            <label for="id_streaming">Filtrar por Título:</label>
            <select name="id_streaming" id="id_streaming" class="form-control ml-2" onchange="this.form.submit()">
                <option value="">-- Todos --</option>
                <?php foreach ($streamings as $stream): ?>
                    <option value="<?= $stream->id_streaming ?>"
                        <?= ($filtro_streaming == $stream->id_streaming) ? 'selected' : '' ?>>
                        <?= esc($stream->nombre_streaming) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </form>

        <!-- TABLA DE VIDEOS -->
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Archivo</th>
                        <th>Nombre Temporada</th>
                        <th>Temporada</th>
                        <th>Capítulo</th>
                        <th style="max-width: 300px;">Descripción</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($videos as $video): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <video width="150" height="90" controls>
                                    <source src="<?= base_url('videos/' . $video->video) ?>" type="video/mp4">
                                    Tu navegador no soporta la reproducción de video.
                                </video>
                            </td>
                            <td><?= esc($video->nombre_temporada) ?></td>
                            <td><?= esc($video->video_temporada) ?></td>
                            <td><?= esc($video->capitulo_temporada) ?></td>
                            <td style="max-width: 300px; overflow-wrap: break-word;">
                                <?= esc($video->descripcion_capitulo_temporada) ?>
                            </td>
                            <td>
                                <?php if ($video->estatus_video == 1): ?>
                                    <span class="badge badge-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactivo</span>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <!-- Estatus -->
                                <?php if ($video->estatus_video == 1): ?>
                                    <a href="<?= route_to('estatus_video', $video->id_video, -1) ?>"
                                       class="btn btn-sm btn-warning"
                                       title="Desactivar"
                                       onclick="return confirm('¿Desactivar este video?')">
                                        <i class="fas fa-toggle-off"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= route_to('estatus_video', $video->id_video, 1) ?>"
                                       class="btn btn-sm btn-success"
                                       title="Activar"
                                       onclick="return confirm('¿Activar este video?')">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                <?php endif ?>

                                <!-- Editar -->
                                <a href="<?= route_to('editar_video', $video->id_video) ?>"
                                   class="btn btn-sm btn-info"
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Eliminar -->
                                <a href="<?= route_to('eliminar_video', $video->id_video) ?>"
                                   class="btn btn-sm btn-danger"
                                   title="Eliminar"
                                   onclick="return confirm('¿Eliminar este video?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
