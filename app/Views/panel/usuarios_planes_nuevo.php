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
    }

    .card-header {
        background: linear-gradient(135deg, #10B981 0%, #047857 100%);
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

    .form-control, select {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, select:focus {
        border-color: #10B981;
        box-shadow: 0 0 0 0.15rem rgba(16, 185, 129, 0.25);
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #10B981;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #047857;
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

    .card-footer {
        background-color: #F0FDF4;
        border-top: 1px solid #D1FAE5;
        padding: 20px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-seedling mr-2"></i>Asignar Nuevo Plan a Usuario
                </h3>
            </div>

            <?= form_open(route_to('guardar_usuario_plan')) ?>
            <div class="card-body">

                <div class="form-group">
                    <label for="id_usuario">Usuario</label>
                    <select name="id_usuario" class="form-control" required>
                        <option value="">Seleccione un usuario</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= esc($usuario->id_usuario) ?>">
                                <?= esc($usuario->nombre_completo) ?> (<?= esc($usuario->email_usuario) ?>)
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_plan">Plan</label>
                    <select name="id_plan" class="form-control" required>
                        <option value="">Seleccione un plan</option>
                        <?php foreach ($planes as $plan): ?>
                            <option value="<?= esc($plan->id_plan) ?>">
                                <?= esc($plan->nombre_plan) ?> - <?= esc($plan->precio_plan) ?> USD
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_registro">Fecha de Registro</label>
                    <input type="date" name="fecha_registro" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin">Fecha de Finalización</label>
                    <input type="date" name="fecha_fin" class="form-control" required>
                </div>

            </div>

            <div class="card-footer text-right">
                <a href="<?= route_to('usuarios_planes') ?>" class="btn btn-secondary">
                    <i class="fas fa-times mr-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary ml-2">
                    <i class="fas fa-save mr-1"></i> Guardar
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
