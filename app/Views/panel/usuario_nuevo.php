<?= $this->extend('plantillas/panel_base') ?>
<?= $this->section('content') ?>

<!-- ESTILOS NUEVOS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F1F5F9;
        color: #1e293b;
    }

    h3.card-title {
        font-weight: 700;
        color: #0f766e;
    }

    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .card-header {
        background-color: #e0f2f1;
        padding: 20px;
        border-bottom: 1px solid #cbd5e1;
    }

    .form-group label {
        font-weight: 600;
        color: #334155;
    }

    .form-control, .form-control-file, select {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 15px;
        background-color: #ffffff;
    }

    .form-control:focus, select:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 0.15rem rgba(13, 148, 136, 0.2);
    }

    .btn-primary {
        background-color: #0f766e;
        border: none;
        padding: 10px 20px;
        font-weight: 600;
        color: white;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background-color: #115e59;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #64748b;
        border: none;
        padding: 10px 20px;
        font-weight: 600;
        color: white;
        border-radius: 10px;
    }

    .btn-secondary:hover {
        background-color: #475569;
        transform: translateY(-1px);
    }

    #preview_foto {
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 5px;
        margin-bottom: 15px;
    }

    .card-footer {
        background-color: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 20px;
    }

    .form-group {
        margin-bottom: 16px;
    }
</style>

<!-- INTERFAZ -->
<div class="row">
    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="card-title"><i class="fas fa-user-circle me-2"></i>Registro de Usuario</h3>
            </div>

            <?= form_open_multipart(route_to('registrar_usuario')) ?>
            <div class="card-body">

                <!-- Previsualización de imagen -->
                <div class="form-group text-center">
                    <label>Foto de perfil</label><br>
                    <img id="preview_foto" src="<?= base_url('perfiles/default.png') ?>" width="120" height="120" alt="Preview">
                </div>

                <div class="form-group">
                    <label for="foto_perfil">Subir imagen</label>
                    <input type="file" name="foto_perfil" id="foto_perfil" class="form-control-file" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" name="apellido_materno" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="1">Masculino</option>
                        <option value="0">Femenino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="rol">Rol del usuario</label>
                    <select name="rol" class="form-control" required>
                        <option value="">Seleccione un rol</option>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol->id_rol ?>"><?= esc($rol->nombre_rol) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="<?= route_to('usuarios') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Guardar Usuario
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- JS para previsualización -->
<script>
    document.getElementById('foto_perfil').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview_foto');
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<?= $this->endSection() ?>
