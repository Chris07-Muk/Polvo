<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    /* Tarjeta contenedora */
    .card {
        background-color: #fefefe;
        border-radius: 16px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        border: 1px solid #d1d5db;
        overflow: hidden;
    }

    .card-header {
        background-color: #f3f4f6;
        color: #1f2937;
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .card-title {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-outline {
        border: 2px solid #2563eb;
        color: #2563eb;
        background-color: transparent;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.25s ease;
        box-shadow: 0 0 0 transparent;
    }

    .btn-outline:hover {
        background-color: #2563eb;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        transform: scale(1.04);
    }

    /* Tabla */
    .table {
        margin-top: 10px;
        border-collapse: collapse;
        width: 100%;
    }

    .table thead {
        background-color: #e2e8f0;
    }

    .table th {
        color: #1f2937;
        font-weight: 700;
        padding: 14px 12px;
        text-align: left;
        font-size: 0.95rem;
    }

    .table td {
        padding: 14px 12px;
        color: #374151;
        font-size: 0.95rem;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 999px;
    }

    .badge-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-warning {
        background-color: #fef3c7;
        color: #92400e;
    }

    /* Botones de acción */
    .btn-action {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        padding: 8px;
        border-radius: 8px;
        color: #4b5563;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        background-color: #e5e7eb;
        color: #1f2937;
        transform: scale(1.05);
    }

    /* Íconos de acciones */
    .acciones {
        display: flex;
        justify-content: flex-start;
        gap: 12px;
    }

    /* Alerta */
    .alert-info {
        background-color: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        padding: 16px;
        border-radius: 10px;
        text-align: center;
        font-weight: 500;
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= route_to('alquiler_nuevo') ?>" class="btn-outline">
                            <i class="fas fa-plus"></i> Nuevo Alquiler
                        </a>
                        <h3 class="card-title"><i class="fas fa-list me-2"></i> Lista de Alquileres</h3>
                    </div>
                    <div class="card-body">
                        <?php if (count($alquileres) > 0): ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cliente</th>
                                            <th>Plataforma</th>
                                            <th>Inicio</th>
                                            <th>Fin</th>
                                            <th>Estatus</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($alquileres as $index => $a): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($a->nombre_usuario . ' ' . $a->ap_usuario) ?></td>
                                                <td><?= esc($a->nombre_streaming) ?></td>
                                                <td><?= esc($a->fecha_inicio_alquiler) ?></td>
                                                <td><?= esc($a->fecha_fin_alquiler) ?></td>
                                                <td>
                                                    <?php if ($a->estatus_alquiler == 1): ?>
                                                        <span class="badge-success">Culminado</span>
                                                    <?php else: ?>
                                                        <span class="badge-warning">En proceso</span>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <div class="acciones">
                                                        <a href="<?= route_to('alquiler_editar', $a->id_alquiler) ?>" class="btn-action" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="<?= route_to('alquiler_eliminar', $a->id_alquiler) ?>" class="btn-action" onclick="return confirm('¿Eliminar este alquiler?')" title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                        <a href="<?= route_to('estatus_alquiler', $a->id_alquiler) ?>" class="btn-action" title="Cambiar estatus">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info mt-3">No hay alquileres registrados por el momento.</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
