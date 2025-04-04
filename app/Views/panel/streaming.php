<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F1F5F9;
        color: #1e293b;
    }

    h4 {
        font-weight: 600;
        color: #0e7490;
    }

    .btn-agregar {
        background-color: #14b8a6;
        color: white;
        border-radius: 10px;
        padding: 10px 22px;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-agregar:hover {
        background-color: #0d9488;
        transform: scale(1.02);
        color: white;
        text-decoration: none;
    }

    .btn-sm {
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 0.85rem;
        color: white;
        margin: 2px;
    }

    .btn-warning {
        background-color: #f59e0b;
        border: none;
    }

    .btn-warning:hover {
        background-color: #d97706;
    }

    .btn-primary {
        background-color: #3b82f6;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2563eb;
    }

    .btn-info {
        background-color: #06b6d4;
        border: none;
    }

    .btn-info:hover {
        background-color: #0891b2;
    }

    .btn-danger {
        background-color: #ef4444;
        border: none;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }

    .badge-success {
        background-color: #10b981;
        padding: 5px 12px;
        border-radius: 10px;
        color: white;
        font-size: 0.8rem;
    }

    .badge-danger {
        background-color: #f87171;
        padding: 5px 12px;
        border-radius: 10px;
        color: white;
        font-size: 0.8rem;
    }

    .table th {
        background-color: #0e7490;
        color: white;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .table-hover tbody tr:hover {
        background-color: #ecfeff;
    }

    td img {
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">🎬 Títulos en Streaming</h4>

        <!-- BOTÓN AGREGAR STREAMING -->
        <a href="<?= route_to('nuevo_streaming') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus-circle"></i> Nuevo Título
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Carátula</th>
                        <th>Duración</th>
                        <th>Temporadas</th>
                        <th>Clasificación</th>
                        <th>Estado</th>
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
                                    <span class="badge badge-success">Disponible</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <!-- Cambiar Estatus -->
                                <?php if ($streaming->estatus_streaming == 1): ?>
                                    <a href="<?= route_to('estatus_streaming', $streaming->id_streaming, -1) ?>"
                                       class="btn btn-sm btn-warning" title="Desactivar"
                                       onclick="return confirm('¿Desactivar este título?')">
                                        <i class="fas fa-toggle-off"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= route_to('estatus_streaming', $streaming->id_streaming, 1) ?>"
                                       class="btn btn-sm btn-primary" title="Activar"
                                       onclick="return confirm('¿Activar este título?')">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                <?php endif; ?>

                                <!-- Editar -->
                                <a href="<?= route_to('editar_streaming', $streaming->id_streaming) ?>"
                                   class="btn btn-sm btn-info" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <!-- Eliminar -->
                                <a href="<?= route_to('eliminar_streaming', $streaming->id_streaming) ?>"
                                   class="btn btn-sm btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Eliminar este título de forma permanente?')">
                                    <i class="fas fa-trash"></i>
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
