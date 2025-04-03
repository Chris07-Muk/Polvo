<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F9FAFB;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
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
        font-size: 1.3rem;
        margin: 0;
    }

    .btn-success {
        background-color: #10B981;
        border: none;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #059669;
        transform: translateY(-1px);
    }

    .table thead {
        background-color: #4F46E5;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #EEF2FF;
    }

    .badge-success {
        background-color: #10B981;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .badge-danger {
        background-color: #EF4444;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .btn-outline-secondary {
        border-radius: 8px;
        font-size: 0.8rem;
    }

    .btn-warning {
        background-color: #F59E0B;
        border: none;
        color: white;
        border-radius: 8px;
    }

    .btn-warning:hover {
        background-color: #D97706;
    }

    .btn-danger {
        background-color: #EF4444;
        border: none;
        color: white;
        border-radius: 8px;
    }

    .btn-danger:hover {
        background-color: #DC2626;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users"></i> Clientes Registrados</h3>
                        <a href="<?= route_to('cliente_nuevo') ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-user-plus"></i> Nuevo Cliente
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (count($clientes) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre Completo</th>
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
                                                    <img src="<?= base_url('perfiles/' . $img) ?>" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                                                </td>
                                                <td>
                                                    <?php if ($cliente->estatus_usuario == 1): ?>
                                                        <span class="badge badge-success">Habilitado</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Deshabilitado</span>
                                                    <?php endif ?>
                                                    <br>
                                                    <a href="<?= route_to('estatus_cliente', $cliente->id_usuario) ?>" class="btn btn-sm btn-outline-secondary mt-1">
                                                        <i class="fas fa-sync-alt"></i> Cambiar
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= route_to('cliente_editar', $cliente->id_usuario) ?>" class="btn btn-warning btn-sm" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= route_to('cliente_eliminar', $cliente->id_usuario) ?>" class="btn btn-danger btn-sm" title="Eliminar"
                                                       onclick="return confirm('¿Deseas eliminar este cliente?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info text-center">No hay clientes registrados.</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
