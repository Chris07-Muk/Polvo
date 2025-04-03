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
        transform: translateY(-1px);
    }

    .table thead {
        background-color: #4F46E5;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #EEF2FF;
    }

    .btn-sm {
        border-radius: 6px;
        padding: 6px 10px;
        font-weight: 500;
        color: white;
        margin: 2px;
    }

    .btn-warning {
        background-color: #F59E0B;
        border: none;
    }

    .btn-warning:hover {
        background-color: #D97706;
    }

    .btn-success {
        background-color: #10B981;
        border: none;
    }

    .btn-success:hover {
        background-color: #059669;
    }

    .btn-info {
        background-color: #06B6D4;
        border: none;
    }

    .btn-info:hover {
        background-color: #0891B2;
    }

    .btn-danger {
        background-color: #EF4444;
        border: none;
    }

    .btn-danger:hover {
        background-color: #DC2626;
    }

    .badge-success {
        background-color: #10B981;
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .badge-danger {
        background-color: #EF4444;
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 12px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Planes Disponibles</h4>

        <a href="<?= route_to('nuevo_plan') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus"></i> Nuevo Plan
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Nombre del Plan</th>
                        <th>Precio</th>
                        <th>Límite</th>
                        <th>Tipo</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($planes as $plan): ?>
                        <tr>
                            <td class="text-center"><?= $i++ ?></td>
                            <td><?= esc($plan->nombre_plan) ?></td>
                            <td>$<?= number_format($plan->precio_plan, 2) ?></td>
                            <td><?= esc($plan->cantidad_limite_plan) ?></td>
                            <td><?= esc($plan->tipo_plan) ?></td>
                            <td class="text-center">
                                <?php if ($plan->estatus_plan == 1): ?>
                                    <span class="badge badge-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactivo</span>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <!-- Estatus -->
                                <?php if ($plan->estatus_plan == 1): ?>
                                    <a href="<?= route_to('estatus_plan', $plan->id_plan, -1) ?>"
                                       class="btn btn-sm btn-warning" title="Desactivar"
                                       onclick="return confirm('¿Desactivar este plan?')">
                                        <i class="fas fa-toggle-off"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= route_to('estatus_plan', $plan->id_plan, 1) ?>"
                                       class="btn btn-sm btn-success" title="Activar"
                                       onclick="return confirm('¿Activar este plan?')">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                <?php endif ?>

                                <!-- Editar -->
                                <a href="<?= route_to('editar_plan', $plan->id_plan) ?>"
                                   class="btn btn-sm btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Eliminar -->
                                <a href="<?= route_to('eliminar_plan', $plan->id_plan) ?>"
                                   class="btn btn-sm btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Eliminar este plan?')">
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
