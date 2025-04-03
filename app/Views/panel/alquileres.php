<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
        background-color: #fff;
    }

    .card-header {
        background: linear-gradient(135deg,rgb(17, 60, 205) 0%,rgb(13, 20, 195) 100%);
        color: white;
        padding: 20px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.4rem;
        margin: 0;
    }

    .btn-agregar {
        background-color: #10B981;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-agregar:hover {
        background-color: #059669;
        transform: translateY(-1px);
    }

    .table {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th {
        background-color:rgb(13, 45, 202);
        color: white;
        font-weight: 500;
        vertical-align: middle;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .badge-success {
        background-color: #16A34A;
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .badge-warning {
        background-color: #F97316;
        color: white;
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .btn-sm {
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 0.875rem;
    }

    .btn-warning {
        background-color: #FACC15;
        color: #1F2937;
        border: none;
    }

    .btn-warning:hover {
        background-color: #EAB308;
    }

    .btn-danger {
        background-color: #EF4444;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #DC2626;
    }

    .btn-info {
        background-color: #3B82F6;
        border: none;
        color: white;
    }

    .btn-info:hover {
        background-color: #2563EB;
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
                        <h3 class="card-title"><i class="fas fa-film mr-2"></i>Alquileres Registrados</h3>
                        <a href="<?= route_to('alquiler_nuevo') ?>" class="btn btn-agregar btn-sm">
                            <i class="fas fa-plus-circle"></i> Nuevo Alquiler
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (count($alquileres) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Streaming</th>
                                            <th>Inicio</th>
                                            <th>Fin</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
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
                                                        <span class="badge badge-success">Culminado</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-warning">En proceso</span>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <a href="<?= route_to('alquiler_editar', $a->id_alquiler) ?>" class="btn btn-warning btn-sm" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= route_to('alquiler_eliminar', $a->id_alquiler) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este alquiler?')" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    <a href="<?= route_to('estatus_alquiler', $a->id_alquiler) ?>" class="btn btn-info btn-sm" title="Cambiar estatus">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info text-center">No hay alquileres registrados.</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
