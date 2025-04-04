<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        background-color: #fefefe;
        border-radius: 16px;
        border: 1px solid #d1d5db;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .card-header {
        background-color: #f3f4f6;
        color: #1f2937;
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-title {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #1f2937;
        display: block;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: border-color 0.2s ease;
        width: 100%;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
        outline: none;
    }

    .card-footer {
        background-color: #f9fafb;
        padding: 20px 24px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-warning {
        background-color: #facc15;
        color: #1f2937;
        border: none;
    }

    .btn-warning:hover {
        background-color: #eab308;
        transform: scale(1.03);
    }

    .btn-secondary {
        background-color: #6b7280;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #4b5563;
        transform: scale(1.03);
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
                        <h3 class="card-title"><i class="fas fa-user-edit"></i> Editar Alquiler</h3>
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

                    <div class="card-footer">
                        <a href="<?= route_to('admin_alquileres') ?>" class="btn btn-secondary">
                            <i class="fas fa-xmark"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-check"></i> Actualizar Alquiler
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
