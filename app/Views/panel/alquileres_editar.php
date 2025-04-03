<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg,rgb(15, 32, 209) 0%,rgb(11, 42, 197) 100%);
        color: white;
        padding: 20px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 0;
    }

    .form-control,
    select {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    select:focus {
        border-color:rgb(17, 42, 204);
        box-shadow: 0 0 0 0.15rem rgba(251, 191, 36, 0.25);
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .card-footer {
        background-color: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        padding: 20px;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-warning {
        background-color:rgb(10, 10, 216);
        border: none;
        color: white;
    }

    .btn-warning:hover {
        background-color:rgb(10, 52, 205);
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
            <div class="col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Editar Alquiler</h3>
                    </div>

                    <?= form_open(route_to('alquiler_actualizar', $alquiler->id_alquiler)) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_usuario">Cliente</label>
                            <select name="id_usuario" class="form-control" required>
                                <option value="">Seleccione un cliente</option>
                                <?php foreach ($usuarios as $u): ?>
                                    <option value="<?= $u->id_usuario ?>" <?= ($u->id_usuario == $alquiler->id_usuario ? 'selected' : '') ?>>
                                        <?= esc($u->nombre_usuario . ' ' . $u->ap_usuario) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_streaming">Servicio de Streaming</label>
                            <select name="id_streaming" class="form-control" required>
                                <option value="">Seleccione una plataforma</option>
                                <?php foreach ($streaming as $s): ?>
                                    <option value="<?= $s->id_streaming ?>" <?= ($s->id_streaming == $alquiler->id_streaming ? 'selected' : '') ?>>
                                        <?= esc($s->nombre_streaming) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio_alquiler">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio_alquiler" class="form-control" value="<?= esc($alquiler->fecha_inicio_alquiler) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_fin_alquiler">Fecha de Fin</label>
                            <input type="date" name="fecha_fin_alquiler" class="form-control" value="<?= esc($alquiler->fecha_fin_alquiler) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="estatus_alquiler">Estatus</label>
                            <select name="estatus_alquiler" class="form-control" required>
                                <option value="-1" <?= ($alquiler->estatus_alquiler == -1 ? 'selected' : '') ?>>En proceso</option>
                                <option value="1" <?= ($alquiler->estatus_alquiler == 1 ? 'selected' : '') ?>>Culminado</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="<?= route_to('alquileres') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning ml-2">
                            <i class="fas fa-save mr-1"></i> Actualizar Alquiler
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
