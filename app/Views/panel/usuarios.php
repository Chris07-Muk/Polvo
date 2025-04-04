<?= $this->extend('plantillas/panel_base') ?>
<?= $this->section('content') ?>

<!-- NUEVOS ESTILOS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F8FAFC;
        color: #1E293B;
    }

    h4 {
        font-weight: 700;
        color: #0f172a;
    }

    .btn-nuevo {
        background-color: #0d9488;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-nuevo:hover {
        background-color: #0f766e;
        transform: scale(1.03);
    }

    .table {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        overflow: hidden;
    }

    .table thead {
        background-color: #0f766e;
        color: white;
        text-align: center;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
        padding: 14px;
        font-size: 0.95rem;
    }

    .table-hover tbody tr:hover {
        background-color: #e2f7f5;
    }

    .badge-success {
        background-color: #16a34a;
        color: white;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .badge-danger {
        background-color: #dc2626;
        color: white;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .acciones {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-sm {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: 0.2s ease;
    }

    .btn-warning {
        background-color: #fbbf24;
        color: #1f2937;
        border: none;
    }

    .btn-warning:hover {
        background-color: #f59e0b;
    }

    .btn-success {
        background-color: #22c55e;
        color: white;
        border: none;
    }

    .btn-success:hover {
        background-color: #16a34a;
    }

    .btn-info {
        background-color: #3b82f6;
        color: white;
        border: none;
    }

    .btn-info:hover {
        background-color: #2563eb;
    }

    .btn-danger {
        background-color: #ef4444;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
    }

    .encabezado {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
</style>

<!-- INTERFAZ -->
<div class="row">
    <div class="col-12">
        <div class="encabezado">
            <h4><i class="fas fa-address-book me-2"></i>Usuarios del Sistema</h4>
            <a href="<?= route_to('usuario_nuevo') ?>" class="btn btn-nuevo">
                <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($usuario->nombre_usuario . ' ' . $usuario->ap_usuario . ' ' . $usuario->am_usuario) ?></td>
                            <td><?= esc($usuario->sexo_usuario == '1' ? 'Masculino' : 'Femenino') ?></td>
                            <td><?= esc($usuario->email_usuario) ?></td>
                            <td><?= esc($usuario->nombre_rol ?? 'Sin Rol') ?></td>
                            <td>
                                <?= $usuario->estatus_usuario == 1
                                    ? '<span class="badge badge-success">Activo</span>'
                                    : '<span class="badge badge-danger">Inactivo</span>' ?>
                            </td>
                            <td>
                                <div class="acciones">
                                    <!-- Activar / Desactivar -->
                                    <?php if ($usuario->estatus_usuario == 1): ?>
                                        <a href="<?= route_to('estatus_usuario', $usuario->id_usuario, 0) ?>"
                                           class="btn btn-sm btn-warning"
                                           title="Desactivar"
                                           onclick="return confirm('¿Desactivar este usuario?')">
                                           <i class="fas fa-power-off"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= route_to('estatus_usuario', $usuario->id_usuario, 1) ?>"
                                           class="btn btn-sm btn-success"
                                           title="Activar"
                                           onclick="return confirm('¿Activar este usuario?')">
                                           <i class="fas fa-play"></i>
                                        </a>
                                    <?php endif ?>

                                    <!-- Editar -->
                                    <a href="<?= route_to('detalles_usuario', $usuario->id_usuario) ?>"
                                       class="btn btn-sm btn-info" title="Editar">
                                       <i class="fas fa-pen"></i>
                                    </a>

                                    <!-- Eliminar -->
                                    <a href="<?= route_to('eliminar_usuario', $usuario->id_usuario) ?>"
                                       class="btn btn-sm btn-danger" title="Eliminar"
                                       onclick="return confirm('¿Eliminar este usuario?')">
                                       <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
