<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .card-header {
        background-color: #f3f4f6;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 auto;
    }

    .btn-outline-success {
        border: 2px solid #10b981;
        color: #10b981;
        background-color: transparent;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-outline-success:hover {
        background-color: #10b981;
        color: white;
        transform: scale(1.03);
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
        text-align: center;
        vertical-align: middle;
        color: #374151;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
    }

    .badge-success {
        background-color: #34d399;
        color: #065f46;
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-danger {
        background-color: #f87171;
        color: #7f1d1d;
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .btn-sm {
        padding: 6px 10px;
        font-size: 0.85rem;
        border-radius: 8px;
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

    .btn-outline-secondary {
        border: 2px solid #6b7280;
        color: #6b7280;
        background-color: transparent;
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #6b7280;
        color: white;
    }

    .img-profile {
        border-radius: 50%;
        width: 56px;
        height: 56px;
        object-fit: cover;
        border: 2px solid #d1d5db;
    }

    .alert-info {
        background-color: #e0f2fe;
        color: #0369a1;
        padding: 14px;
        border-radius: 12px;
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
                        <a href="<?= route_to('cliente_nuevo') ?>" class="btn-outline-success">
                            <i class="fas fa-user-plus"></i> Nuevo Cliente
                        </a>
                        <h3 class="card-title"><i class="fas fa-people-group"></i> Clientes Registrados</h3>
                    </div>
                    <div class="card-body">
                        <?php if (count($clientes) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Sexo</th>
                                            <th>Imagen</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes as $index => $cliente): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($cliente->nombre_usuario . ' ' . $cliente->ap_usuario . ' ' . $cliente->am_usuario) ?></td>
                                                <td><?= esc($cliente->email_usuario) ?></td>
                                                <td><?= $cliente->sexo_usuario == 1 ? 'Masculino' : 'Femenino' ?></td>
                                                <td>
                                                    <?php $img = $cliente->imagen_usuario ?? 'hombre.png'; ?>
                                                    <img src="<?= base_url('perfiles/' . $img) ?>" class="img-profile">
                                                </td>
                                                <td>
                                                    <?php if ($cliente->estatus_usuario == 1): ?>
                                                        <span class="badge badge-success">Habilitado</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Deshabilitado</span>
                                                    <?php endif ?>
                                                    <div class="mt-2">
                                                        <a href="<?= route_to('estatus_cliente', $cliente->id_usuario) ?>" class="btn-outline-secondary">
                                                            <i class="fas fa-repeat"></i> Estatus
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?= route_to('cliente_editar', $cliente->id_usuario) ?>" class="btn btn-warning btn-sm" title="Editar">
                                                        <i class="fas fa-user-gear"></i>
                                                    </a>
                                                    <a href="<?= route_to('cliente_eliminar', $cliente->id_usuario) ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                                       onclick="return confirm('¿Deseas eliminar este cliente?')">
                                                        <i class="fas fa-trash-can"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info mt-3">No hay clientes registrados.</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
