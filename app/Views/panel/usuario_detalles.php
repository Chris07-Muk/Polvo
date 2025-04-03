<?= $this->extend('plantillas/panel_base') ?>
<?= $this->section('content') ?>

<!-- ESTILOS INTEGRADOS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F9FAFB;
        color: #111827;
    }

    h4 {
        font-weight: 600;
        color: #4F46E5;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 25px;
        background-color: #ffffff;
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

    .btn-success {
        background-color: #10B981;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        color: white;
    }

    .btn-success:hover {
        background-color: #059669;
    }

    .btn-secondary {
        background-color: #6B7280;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #4B5563;
    }

    img.rounded-circle {
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #E5E7EB;
        margin-bottom: 10px;
    }
</style>

<!-- INTERFAZ -->
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h4 class="mb-4">Detalles del Usuario</h4>

        <div class="card">
            <?= form_open_multipart(route_to('editar_usuario', $usuario->id_usuario)) ?>

            <div class="form-group text-center">
                <?php if (!empty($usuario->imagen_usuario)): ?>
                    <img src="<?= base_url('perfiles/' . $usuario->imagen_usuario) ?>" class="rounded-circle mb-3" width="120" height="120" alt="Foto de perfil">
                <?php else: ?>
                    <img src="<?= base_url('perfiles/' . (($usuario->sexo_usuario == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg')) ?>" class="rounded-circle mb-3" width="120" height="120" alt="Sin foto">
                <?php endif ?>
                <input type="file" name="foto_perfil" class="form-control-file mt-2">
            </div>

            <div class="form-group">
                <label for="nombre">Nombre(s)</label>
                <input type="text" name="nombre" class="form-control" value="<?= esc($usuario->nombre_usuario) ?>" required>
            </div>

            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" value="<?= esc($usuario->ap_usuario) ?>" required>
            </div>

            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" value="<?= esc($usuario->am_usuario) ?>" required>
            </div>

            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select name="sexo" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="<?= MASCULINO ?>" <?= ($usuario->sexo_usuario == MASCULINO) ? 'selected' : '' ?>>Masculino</option>
                    <option value="<?= FEMENINO ?>" <?= ($usuario->sexo_usuario == FEMENINO) ? 'selected' : '' ?>>Femenino</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="<?= esc($usuario->email_usuario) ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Nueva Contraseña (opcional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="repassword">Repetir Contraseña</label>
                <input type="password" name="repassword" class="form-control">
            </div>

            <div class="form-group">
                <label for="rol">Rol de Usuario</label>
                <select name="rol" class="form-control" required>
                    <option value="">Seleccione un rol</option>
                    <option value="<?= ROL_ADMINISTRADOR['clave'] ?>" <?= ($usuario->id_rol == ROL_ADMINISTRADOR['clave']) ? 'selected' : '' ?>><?= ROL_ADMINISTRADOR['rol'] ?></option>
                    <option value="<?= ROL_OPERADOR['clave'] ?>" <?= ($usuario->id_rol == ROL_OPERADOR['clave']) ? 'selected' : '' ?>><?= ROL_OPERADOR['rol'] ?></option>
                    <option value="<?= ROL_CLIENTE['clave'] ?>" <?= ($usuario->id_rol == ROL_CLIENTE['clave']) ? 'selected' : '' ?>><?= ROL_CLIENTE['rol'] ?></option>
                </select>
            </div>

            <div class="form-group mt-4 text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
                <a href="<?= route_to('usuarios') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
