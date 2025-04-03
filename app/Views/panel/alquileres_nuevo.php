<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        background-color: #fff;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg,rgb(12, 17, 182) 0%,rgb(24, 24, 185) 100%);
        color: white;
        padding: 20px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.4rem;
        margin: 0;
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color:rgb(14, 29, 190);
        box-shadow: 0 0 0 0.15rem rgba(91, 33, 182, 0.25);
    }

    .card-footer {
        background-color: #F8FAFC;
        border-top: 1px solid #E5E7EB;
        padding: 20px;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background-color:rgb(27, 44, 198);
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #4C1D95;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #6B7280;
        border: none;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #4B5563;
        transform: translateY(-1px);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-film mr-2"></i> Nuevo Alquiler</h3>
                    </div>

                    <?= form_open(route_to('alquiler_guardar')) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_usuario">Usuario</label>
                            <select name="id_usuario" class="form-control" required>
                                <option value="">Selecciona un usuario</option>
                                <?php foreach ($usuarios as $u): ?>
                                    <option value="<?= $u->id_usuario ?>">
                                        <?= esc($u->nombre_usuario . ' ' . $u->ap_usuario) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_streaming">Contenido Streaming</label>
                            <select name="id_streaming" class="form-control" required>
                                <option value="">Selecciona contenido</option>
                                <?php foreach ($streamings as $s): ?>
                                    <option value="<?= $s->id_streaming ?>">
                                        <?= esc($s->nombre_streaming) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio_alquiler">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio_alquiler" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_fin_alquiler">Fecha de finalización</label>
                            <input type="date" name="fecha_fin_alquiler" class="form-control" required>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="<?= route_to('alquileres') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Registrar Alquiler
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
