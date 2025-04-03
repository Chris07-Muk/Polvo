<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables-bs4/css/dataTables.bootstrap4.min.css' ?>">
<link rel="stylesheet" href="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS) . '/datatables-responsive/css/responsive.bootstrap4.min.css' ?>">

<!-- DISEÑO UNIFICADO -->
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
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-agregar:hover {
        background-color: #4338CA;
        color: white;
        transform: translateY(-1px);
    }

    .btn-sm {
        border-radius: 6px;
        padding: 6px 10px;
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

    .btn-primary {
        background-color: #3B82F6;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2563EB;
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

    .badge-success {
        background-color: #10B981;
        padding: 5px 10px;
        border-radius: 8px;
        color: white;
    }

    .badge-danger {
        background-color: #EF4444;
        padding: 5px 10px;
        border-radius: 8px;
        color: white;
    }

    .table th {
        background-color: #4F46E5;
        color: white;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background-color: #EEF2FF;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Listado de Géneros</h4>

        <!-- BOTÓN AGREGAR GÉNERO -->
        <a href="<?= route_to('nuevo_genero') ?>" class="btn btn-agregar mb-3">
            <i class="fas fa-plus"></i> Nuevo Género
        </a>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
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
                            <td class="text-center">
                                <!-- Estatus -->
                                <?php if ($genero->estatus_genero == 1): ?>
                                    <a href="<?= route_to('estatus_genero', $genero->id_genero, -1) ?>"
                                       class="btn btn-sm btn-warning"
                                       title="Deshabilitar"
                                       onclick="return confirm('¿Deseas deshabilitar este género?')">
                                        <i class="fas fa-user-slash"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= route_to('estatus_genero', $genero->id_genero, 1) ?>"
                                       class="btn btn-sm btn-primary"
                                       title="Habilitar"
                                       onclick="return confirm('¿Deseas habilitar este género?')">
                                        <i class="fas fa-user-check"></i>
                                    </a>
                                <?php endif; ?>

                                <!-- Editar -->
                                <a href="<?= route_to('editar_genero', $genero->id_genero) ?>"
                                   class="btn btn-sm btn-info"
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Eliminar -->
                                <a href="<?= route_to('eliminar_genero', $genero->id_genero) ?>"
                                   class="btn btn-sm btn-danger"
                                   title="Eliminar"
                                   onclick="return confirm('¿Estás seguro de eliminar este género?')">
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
                lengthMenu: "Mostrar _MENU_ registros por página",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros disponibles",
                search: "<i class='fas fa-search'></i> Buscar:",
                zeroRecords: "No se encontraron registros coincidentes",
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>",
                    next: "<i class='fas fa-angle-right'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
