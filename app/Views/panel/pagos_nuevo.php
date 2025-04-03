<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
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
        border-color: #3B82F6;
        box-shadow: 0 0 0 0.15rem rgba(59, 130, 246, 0.25);
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
        background-color:rgb(17, 86, 197);
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color:rgb(17, 69, 181);
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
                        <h3 class="card-title"><i class="fas fa-money-check-alt mr-2"></i>Registrar nuevo pago</h3>
                    </div>

                    <?= form_open(route_to('pago_guardar')) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fecha_registro_pago">Fecha de registro</label>
                            <input type="date" name="fecha_registro_pago" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="monto_pago">Monto del pago</label>
                            <input type="number" name="monto_pago" class="form-control" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="tarjeta_pago">Tarjeta asociada</label>
                            <input type="text" name="tarjeta_pago" class="form-control" maxlength="32" placeholder="**** **** **** 1234" required>
                        </div>

                        <div class="form-group">
                            <label for="id_usuario">Usuario</label>
                            <select name="id_usuario" class="form-control" required>
                                <option value="">Seleccionar usuario</option>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?= $usuario->id_usuario ?>">
                                        <?= esc($usuario->nombre_usuario . ' ' . $usuario->ap_usuario . ' ' . $usuario->am_usuario) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_plan">Plan</label>
                            <select name="id_plan" class="form-control" required>
                                <option value="">Seleccionar plan</option>
                                <?php foreach ($planes as $plan): ?>
                                    <option value="<?= $plan->id_plan ?>">
                                        <?= esc($plan->nombre_plan) ?> - $<?= esc($plan->precio_plan) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="<?= route_to('pagos') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary ml-2">
                            <i class="fas fa-save mr-1"></i> Guardar Pago
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
