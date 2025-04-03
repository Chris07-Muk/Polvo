<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg, #6366F1 0%, #4338CA 100%);
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
        border-color: #6366F1;
        box-shadow: 0 0 0 0.15rem rgba(99, 102, 241, 0.25);
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

    .btn-primary {
        background-color: #6366F1;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #4338CA;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color:rgb(33, 176, 1);
        border: none;
        color: white;
    }

    .btn-secondary:hover {
        background-color:rgb(0, 207, 38);
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Editar Pago</h3>
                        <a href="<?= route_to('pagos') ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                    </div>

                    <?= form_open(route_to('pago_actualizar', $pago->id_pago)) ?>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_usuario">Usuario</label>
                            <select name="id_usuario" class="form-control" required>
                                <option value="">Seleccionar usuario</option>
                                <?php foreach ($usuarios as $u): ?>
                                    <option value="<?= $u->id_usuario ?>" <?= ($u->id_usuario == $pago->id_usuario) ? 'selected' : '' ?>>
                                        <?= esc($u->nombre_usuario . ' ' . $u->ap_usuario) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_plan">Plan</label>
                            <select name="id_plan" class="form-control" required>
                                <option value="">Seleccionar plan</option>
                                <?php foreach ($planes as $plan): ?>
                                    <option value="<?= $plan->id_plan ?>" <?= ($plan->id_plan == $pago->id_plan) ? 'selected' : '' ?>>
                                        <?= esc($plan->nombre_plan) ?> - $<?= number_format($plan->precio_plan, 2) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_registro_pago">Fecha</label>
                            <input type="date" name="fecha_registro_pago" class="form-control"
                                   value="<?= esc($pago->fecha_registro_pago) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="monto_pago">Monto</label>
                            <input type="number" step="0.01" name="monto_pago" class="form-control"
                                   value="<?= esc($pago->monto_pago) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="tarjeta_pago">Tarjeta</label>
                            <input type="text" name="tarjeta_pago" class="form-control" maxlength="32"
                                   value="<?= esc($pago->tarjeta_pago) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="estatus_pago">Estatus</label>
                            <select name="estatus_pago" class="form-control" required>
                                <option value="-1" <?= ($pago->estatus_pago == -1) ? 'selected' : '' ?>>Rechazado</option>
                                <option value="0" <?= ($pago->estatus_pago == 0) ? 'selected' : '' ?>>Pendiente</option>
                                <option value="1" <?= ($pago->estatus_pago == 1) ? 'selected' : '' ?>>Aceptado</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Guardar Cambios
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
