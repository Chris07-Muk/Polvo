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
        color: #10B981;
        margin-bottom: 25px;
    }

    .btn-agregar {
        background-color: #10B981;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-agregar i {
        margin-right: 8px;
    }

    .btn-agregar:hover {
        background-color: #059669;
        transform: translateY(-1px);
        color: white;
    }

    .table th {
        background-color: #10B981;
        color: white;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #ECFDF5;
    }

    .btn-sm {
        border-radius: 6px;
        padding: 6px 10px;
        font-weight: 500;
        color: white;
        margin: 2px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-info {
        background-color: #34D399;
        border: none;
    }

    .btn-info:hover {
        background-color: #10B981;
    }

    .btn-danger {
        background-color: #F87171;
        border: none;
    }

    .btn-danger:hover {
        background-color: #DC2626;
    }

    .acciones {
        display: flex;
        justify-content: center;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4"><i class="fas fa-user-cog mr-2"></i> Relación Usuario - Plan</h4>

        <a href="<?= route_to('nuevo_usuario_plan') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus-circle"></i> Añadir Relación
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-user"></i> Usuario</th>
                        <th><i class="fas fa-crown"></i> Plan</th>
                        <th><i class="fas fa-calendar-plus"></i> Registro</th>
                        <th><i class="fas fa-calendar-check"></i> Fin</th>
                        <th class="text-center"><i class="fas fa-tools"></i> Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($usuarios_planes as $item): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($item['nombre_usuario']) ?></td>
                            <td><?= esc($item['nombre_plan']) ?></td>
                            <td><?= esc($item['fecha_registro_plan']) ?></td>
                            <td><?= esc($item['fecha_fin_plan']) ?></td>
                            <td class="acciones">
                                <a href="<?= route_to('editar_usuario_plan', $item['id_usuario_plan']) ?>"
                                   class="btn btn-sm btn-info" title="Editar">
                                    <i class="fas fa-pen"></i> Editar
                                </a>

                                <a href="<?= route_to('eliminar_usuario_plan', $item['id_usuario_plan']) ?>"
                                   class="btn btn-sm btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Eliminar esta relación?')">
                                    <i class="fas fa-trash"></i> Eliminar
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
