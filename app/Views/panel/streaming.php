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
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-agregar:hover {
        background-color: #4338CA;
        color: white;
        transform: translateY(-1px);
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

    .btn-primary {
        background-color: #3B82F6;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2563EB;
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

    .table th {
        background-color: #4F46E5;
        color: white;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background-color: #EEF2FF;
    }

    td img {
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Listado de Streaming</h4>

        <!-- BOTÓN AGREGAR STREAMING -->
        <a href="<?= route_to('nuevo_streaming') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus"></i> Nuevo Streaming
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Carátula</th>
                        <th>Duración</th>
                        <th>Temporadas</th>
                        <th>Clasificación</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($streamings as $streaming): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($streaming->nombre_streaming) ?></td>
                            <td>
                                <img src="<?= base_url('streaming/caratulas/' . $streaming->caratula_streaming) ?>" width="60" height="90" alt="Carátula">
                            </td>
                            <td><?= esc($streaming->duracion_streaming) ?></td>
                            <td><?= esc($streaming->temporadas_streaming) ?></td>
                            <td><?= esc($streaming->clasificacion_streaming) ?></td>
                            <td>
                                <?php if ($streaming->estatus_streaming == 1): ?>
                                    <span class="badge badge-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <!-- Estatus -->
                                <?php if ($streaming->estatus_streaming == 1): ?>
                                    <a href="<?= route_to('estatus_streaming', $streaming->id_streaming, -1) ?>"
                                       class="btn btn-sm btn-warning"
                                       title="Deshabilitar"
                                       onclick="return confirm('¿Deseas deshabilitar este título?')">
                                        <i class="fas fa-toggle-off"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= route_to('estatus_streaming', $streaming->id_streaming, 1) ?>"
                                       class="btn btn-sm btn-primary"
                                       title="Habilitar"
                                       onclick="return confirm('¿Deseas habilitar este título?')">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                <?php endif; ?>

                                <!-- Editar -->
                                <a href="<?= route_to('editar_streaming', $streaming->id_streaming) ?>"
                                   class="btn btn-sm btn-info"
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Eliminar -->
                                <a href="<?= route_to('eliminar_streaming', $streaming->id_streaming) ?>"
                                   class="btn btn-sm btn-danger"
                                   title="Eliminar"
                                   onclick="return confirm('¿Estás seguro de eliminar este título?')">
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
