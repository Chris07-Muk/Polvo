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
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-agregar:hover {
        background-color: #4338CA;
        color: white;
        transform: translateY(-1px);
    }

    .table th {
        background-color: #4F46E5;
        color: white;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background-color: #EEF2FF;
    }

    .btn-sm {
        border-radius: 6px;
        padding: 6px 10px;
        color: white;
        margin: 2px;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Relación Usuario - Plan</h4>

        <a href="<?= route_to('nuevo_usuario_plan') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus"></i> Nuevo Usuario Plan
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Plan</th>
                        <th>Fecha de Registro</th>
                        <th>Fecha de Fin</th>
                        <th class="text-center">Acciones</th>
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
                            <td class="text-center">
                                <a href="<?= route_to('editar_usuario_plan', $item['id_usuario_plan']) ?>"
                                   class="btn btn-sm btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="<?= route_to('eliminar_usuario_plan', $item['id_usuario_plan']) ?>"
                                   class="btn btn-sm btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Eliminar este registro?')">
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
