<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        background-color: #fefefe;
        border-radius: 16px;
        border: 1px solid #d1d5db;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
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
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .btn-outline-success {
        border: 2px solid #22c55e;
        background-color: transparent;
        color: #22c55e;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn-outline-success:hover {
        background-color: #22c55e;
        color: white;
        transform: scale(1.03);
    }

    .table {
        margin-top: 10px;
    }

    .table thead {
        background-color: #e2e8f0;
    }

    .table th {
        padding: 14px;
        font-weight: 700;
        color: #1f2937;
        text-align: center;
    }

    .table td {
        padding: 12px;
        font-size: 0.95rem;
        color: #374151;
        text-align: center;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
    }

    .btn-sm {
        padding: 7px 12px;
        font-size: 0.85rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-success {
        background-color: #22c55e;
        border: none;
        color: white;
    }

    .btn-success:hover {
        background-color: #16a34a;
    }

    .btn-warning {
        background-color: #fbbf24;
        border: none;
        color: #1f2937;
    }

    .btn-warning:hover {
        background-color: #f59e0b;
    }

    .btn-danger {
        background-color: #ef4444;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }

    .alert-info {
        background-color: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        padding: 16px;
        border-radius: 10px;
        text-align: center;
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
                        <a href="<?= route_to('pago_nuevo') ?>" class="btn-outline-success">
                            <i class="fas fa-plus-circle"></i> Nuevo Pago
                        </a>
                        <h3 class="card-title"><i class="fas fa-credit-card"></i> Pagos Registrados</h3>
                    </div>
                    <div class="card-body">
                        <?php if (count($pagos) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Plan</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Tarjeta</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pagos as $index => $p): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($p->nombre_usuario . ' ' . $p->ap_usuario) ?></td>
                                                <td><?= esc($p->nombre_plan) ?></td>
                                                <td><?= esc($p->fecha_registro_pago) ?></td>
                                                <td>$<?= number_format($p->monto_pago, 2) ?></td>
                                                <td><?= esc($p->tarjeta_pago) ?></td>
                                                <td>
                                                    <?php if ($p->estatus_pago == 1): ?>
                                                        <a href="<?= route_to('pago_estatus', $p->id_pago) ?>"
                                                           class="btn btn-success btn-sm" title="Marcar como Rechazado">
                                                            <i class="fas fa-check-circle"></i> Aceptado
                                                        </a>
                                                    <?php elseif ($p->estatus_pago == 0): ?>
                                                        <a href="<?= route_to('pago_estatus', $p->id_pago) ?>"
                                                           class="btn btn-warning btn-sm" title="Aceptar/Rechazar">
                                                            <i class="fas fa-clock"></i> Pendiente
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?= route_to('pago_estatus', $p->id_pago) ?>"
                                                           class="btn btn-danger btn-sm" title="Marcar como Aceptado">
                                                            <i class="fas fa-times-circle"></i> Rechazado
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= route_to('pago_editar', $p->id_pago) ?>" class="btn btn-warning btn-sm" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= route_to('pago_eliminar', $p->id_pago) ?>"
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('¿Eliminar este pago?')"
                                                       title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info mt-3">No hay pagos registrados.</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
