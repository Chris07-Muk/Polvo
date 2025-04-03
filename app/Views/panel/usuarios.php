<?= $this->extend('plantillas/panel_base') ?>
<?= $this->section('content') ?>

<!-- ESTILOS INTEGRADOS -->
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

    .table {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #4F46E5;
        color: white;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #EEF2FF;
    }

    .btn-agregar {
        background-color: #4F46E5;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-agregar:hover {
        background-color: #4338CA;
        color: white;
    }

    .btn-sm {
        margin: 2px;
        border-radius: 6px;
    }

    .btn-info {
        background-color: #3B82F6;
        color: white;
    }

    .btn-info:hover {
        background-color: #2563EB;
        color: white;
    }

    .btn-warning {
        background-color: #F59E0B;
        color: white;
    }

    .btn-warning:hover {
        background-color: #D97706;
        color: white;
    }

    .btn-success {
        background-color: #10B981;
        color: white;
    }

    .btn-success:hover {
        background-color: #059669;
        color: white;
    }

    .btn-danger {
        background-color: #EF4444;
        color: white;
    }

    .btn-danger:hover {
        background-color: #DC2626;
        color: white;
    }

    .badge-success {
        background-color: #10B981;
        color: white;
        padding: 5px 10px;
        border-radius: 8px;
    }

    .badge-danger {
        background-color: #EF4444;
        color: white;
        padding: 5px 10px;
        border-radius: 8px;
    }
</style>

<!-- INTERFAZ -->
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Listado de Usuarios</h4>

        <a href="<?= route_to('usuario_nuevo') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($usuario->nombre_usuario . ' ' . $usuario->ap_usuario . ' ' . $usuario->am_usuario) ?></td>
                            <td><?= esc(($usuario->sexo_usuario == '1') ? 'Masculino' : 'Femenino') ?></td>
                            <td><?= esc($usuario->email_usuario) ?></td>
                            <td><?= esc($usuario->nombre_rol ?? 'Sin Rol') ?></td>
                            <td>
                                <?php if ($usuario->estatus_usuario == 1): ?>
                                    <span class="badge badge-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactivo</span>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <!-- Estatus -->
                                <?php if ($usuario->estatus_usuario == 1): ?>
                                    <a href="<?= route_to('estatus_usuario', $usuario->id_usuario, 0) ?>"
                                       class="btn btn-sm btn-warning"
                                       title="Desactivar"
                                       onclick="return confirm('¿Desactivar este usuario?')">
                                        <i class="fas fa-toggle-off"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= route_to('estatus_usuario', $usuario->id_usuario, 1) ?>"
                                       class="btn btn-sm btn-success"
                                       title="Activar"
                                       onclick="return confirm('¿Activar este usuario?')">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                <?php endif ?>

                                <!-- Editar -->
                                <a href="<?= route_to('detalles_usuario', $usuario->id_usuario) ?>"
                                   class="btn btn-sm btn-info"
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Eliminar -->
                                <a href="<?= route_to('eliminar_usuario', $usuario->id_usuario) ?>"
                                   class="btn btn-sm btn-danger"
                                   title="Eliminar"
                                   onclick="return confirm('¿Eliminar este usuario?')">
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
