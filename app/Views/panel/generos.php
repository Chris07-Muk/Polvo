<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables-bs4/css/dataTables.bootstrap4.min.css' ?>">
<link rel="stylesheet" href="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables-responsive/css/responsive.bootstrap4.min.css' ?>">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F1F5F9;
        color: #0f172a;
    }

    h4 {
        font-weight: 700;
        color: #0f766e;
        margin-bottom: 20px;
    }

    .btn-agregar {
        background-color: #0f766e;
        color: white;
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-agregar:hover {
        background-color: #115e59;
        transform: translateY(-1px);
        color: white;
    }

    .table th {
        background-color: #0f766e;
        color: white;
        text-align: center;
        font-weight: 600;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background-color: #e0f2fe;
    }

    .btn-sm {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.85rem;
    }

    .btn-primary {
        background-color: #0284c7;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0369a1;
    }

    .btn-warning {
        background-color: #fbbf24;
        border: none;
        color: #1f2937;
    }

    .btn-warning:hover {
        background-color: #f59e0b;
    }

    .btn-info {
        background-color: #38bdf8;
        border: none;
        color: #1e293b;
    }

    .btn-info:hover {
        background-color: #0ea5e9;
    }

    .btn-danger {
        background-color: #f87171;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #ef4444;
    }

    .badge-success {
        background-color: #10b981;
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 10px;
    }

    .badge-danger {
        background-color: #ef4444;
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 10px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4>🎬 Gestión de Géneros</h4>

        <a href="<?= route_to('nuevo_genero') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-folder-plus mr-1"></i> Crear Género
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($generos as $genero): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($genero->nombre_genero) ?></td>
                            <td><?= esc($genero->descripcion_genero) ?></td>
                            <td>
                                <?php if ($genero->estatus_genero == 1): ?>
                                    <span class="badge badge-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($genero->estatus_genero == 1): ?>
                                    <a href="<?= route_to('estatus_genero', $genero->id_genero, -1) ?>"
                                       class="btn btn-sm btn-warning" title="Deshabilitar"
                                       onclick="return confirm('¿Desactivar este género?')">
                                       <i class="fas fa-eye-slash"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= route_to('estatus_genero', $genero->id_genero, 1) ?>"
                                       class="btn btn-sm btn-primary" title="Habilitar"
                                       onclick="return confirm('¿Habilitar este género?')">
                                       <i class="fas fa-eye"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="<?= route_to('editar_genero', $genero->id_genero) ?>"
                                   class="btn btn-sm btn-info" title="Editar">
                                   <i class="fas fa-pen"></i>
                                </a>

                                <a href="<?= route_to('eliminar_genero', $genero->id_genero) ?>"
                                   class="btn btn-sm btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Eliminar este género?')">
                                   <i class="fas fa-trash"></i>
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

<?= $this->section('js') ?>
<script src="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables/jquery.dataTables.min.js' ?>"></script>
<script src="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables-bs4/js/dataTables.bootstrap4.min.js' ?>"></script>
<script src="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables-responsive/js/dataTables.responsive.min.js' ?>"></script>
<script src="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables-responsive/js/responsive.bootstrap4.min.js' ?>"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            responsive: true,
            language: {
                lengthMenu: "Mostrar _MENU_ géneros",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "Sin géneros registrados",
                search: "<i class='fas fa-search'></i> Buscar:",
                zeroRecords: "No se encontraron géneros",
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>",
                    next: "<i class='fas fa-angle-right'></i>",
                    previous: "<i class='fas fa-angle-left'></i>"
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
