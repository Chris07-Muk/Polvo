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

    .btn-primary {
        background-color: #2563eb;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
        transform: scale(1.03);
    }

    .btn-secondary {
        background-color: #6b7280;
        border: none;
        color: white;
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
                        <h3 class="card-title"><i class="fas fa-file-invoice-dollar"></i> Registrar Pago</h3>
                    </div>

                    <?= form_open(route_to('pago_guardar')) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fecha_registro_pago">Fecha de Registro</label>
                            <input type="date" name="fecha_registro_pago" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="monto_pago">Monto del Pago</label>
                            <input type="number" name="monto_pago" class="form-control" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="tarjeta_pago">Tarjeta Asociada</label>
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

                    <div class="card-footer">
                        <a href="<?= route_to('pagos') ?>" class="btn btn-secondary">
                            <i class="fas fa-ban"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Guardar Pago
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
