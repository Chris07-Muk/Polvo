<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F9FAFB;
        color: #111827;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        background-color: #FFFFFF;
    }

    .card-header {
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        color: white;
        padding: 20px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.5rem;
        margin: 0;
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control, select {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, select:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 0.15rem rgba(79, 70, 229, 0.25);
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
        background-color: #4F46E5;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #4338CA;
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
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Editar Plan</h3>
            </div>

            <?= form_open(route_to('actualizar_plan', $plan->id_plan)) ?>
            <div class="card-body">

                <div class="form-group">
                    <label for="nombre">Nombre del Plan</label>
                    <input type="text" name="nombre" class="form-control" required value="<?= esc($plan->nombre_plan) ?>">
                </div>

                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" required value="<?= esc($plan->precio_plan) ?>">
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad Límite</label>
                    <input type="number" name="cantidad" class="form-control" required value="<?= esc($plan->cantidad_limite_plan) ?>">
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de Plan</label>
                    <select name="tipo" id="tipo" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <option value="8" <?= ($plan->tipo_plan == 8) ? 'selected' : '' ?>>Semanal</option>
                        <option value="16" <?= ($plan->tipo_plan == 16) ? 'selected' : '' ?>>Mensual</option>
                        <option value="32" <?= ($plan->tipo_plan == 32) ? 'selected' : '' ?>>Anual</option>
                    </select>
                </div>

            </div>

            <div class="card-footer text-right">
                <a href="<?= route_to('planes') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Volver al listado
                </a>
                <button type="submit" class="btn btn-primary ml-2">
                    <i class="fas fa-save mr-1"></i> Actualizar Plan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
