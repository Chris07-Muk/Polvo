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
    }

    .btn-agregar {
        background-color: #10B981;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-agregar:hover {
        background-color: #047857;
        transform: translateY(-1px);
    }

    .table thead {
        background-color: #10B981;
        color: white;
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
        transition: 0.2s;
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
        background-color: #047857;
    }

    .btn-info {
        background-color: #3B82F6;
        border: none;
    }

    .btn-info:hover {
        background-color: #2563EB;
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
        padding: 5px 12px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .badge-danger {
        background-color: #EF4444;
        font-size: 0.85rem;
        padding: 5px 12px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4"><i class="fas fa-list-alt mr-2"></i>Planes Disponibles</h4>

        <a href="<?= route_to('nuevo_plan') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus-circle"></i> Nuevo Plan
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
