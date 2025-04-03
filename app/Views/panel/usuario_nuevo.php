<?= $this->extend('plantillas/panel_base') ?>
<?= $this->section('content') ?>

<!-- ESTILOS INTEGRADOS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F9FAFB;
        color: #111827;
    }

    h3.card-title {
        color: #4F46E5;
        font-weight: 600;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background-color: #EEF2FF;
        border-bottom: 1px solid #ddd;
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
    }

    .form-control, .form-control-file, select {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px;
    }

    .form-control:focus, select:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 0.1rem rgba(79, 70, 229, 0.25);
    }

    .btn-primary {
        background-color: #4F46E5;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-primary:hover {
        background-color: #4338CA;
    }

    .btn-secondary {
        background-color: #6B7280;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-secondary:hover {
        background-color: #4B5563;
    }

    img#preview_foto {
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #E5E7EB;
        margin-bottom: 10px;
    }
</style>

<!-- INTERFAZ -->
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrar Nuevo Usuario</h3>
            </div>

            <?= form_open_multipart(route_to('registrar_usuario')) ?>
            <div class="card-body">

                <!-- Imagen Preview -->
                <div class="form-group text-center">
                    <label>Vista Previa de Foto</label><br>
                    <img id="preview_foto" src="<?= base_url('perfiles/default.png') ?>" alt="Vista previa"
                         width="120" height="120">
                </div>

                <div class="form-group">
                    <label for="foto_perfil">Foto de Perfil</label>
                    <input type="file" name="foto_perfil" id="foto_perfil" class="form-control-file" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
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
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select name="rol" class="form-control" required>
                        <option value="">Seleccione un rol</option>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol->id_rol ?>">
                                <?= esc($rol->nombre_rol) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

            </div>

            <div class="card-footer text-right">
                <a href="<?= route_to('usuarios') ?>" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Script para previsualizar la imagen -->
<script>
    document.getElementById('foto_perfil').addEventListener('change', function (e) {
        const input = e.target;
        const preview = document.getElementById('preview_foto');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>

<?= $this->endSection() ?>
