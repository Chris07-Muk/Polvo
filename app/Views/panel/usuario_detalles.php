<?= $this->extend('plantillas/panel_base') ?>
<?= $this->section('content') ?>

<!-- ESTILOS MODERNOS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F3F4F6;
        color: #1e293b;
    }

    h4 {
        font-weight: 700;
        color: #0f766e;
        text-align: center;
        margin-bottom: 25px;
    }

    .card {
        border-radius: 14px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        border: none;
        background-color: #ffffff;
        padding: 30px;
    }

    .form-group label {
        font-weight: 600;
        color: #334155;
    }

    .form-control, .form-control-file, select {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 15px;
        background-color: #fff;
    }

    .form-control:focus, select:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 0.15rem rgba(13, 148, 136, 0.25);
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

    .img-preview {
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 3px solid #e2e8f0;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .card-footer {
        border-top: 1px solid #e5e7eb;
        background-color: #f8fafc;
        padding-top: 20px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<!-- FORMULARIO -->
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4>Editar Información del Usuario</h4>

        <div class="card">
            <?= form_open_multipart(route_to('editar_usuario', $usuario->id_usuario)) ?>

            <div class="form-group text-center">
                <?php if (!empty($usuario->imagen_usuario)): ?>
                    <img src="<?= base_url('perfiles/' . $usuario->imagen_usuario) ?>" class="img-preview" width="120" height="120" alt="Foto de perfil">
                <?php else: ?>
                    <img src="<?= base_url('perfiles/' . (($usuario->sexo_usuario == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg')) ?>" class="img-preview" width="120" height="120" alt="Sin foto">
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
                    <option value="<?= ROL_ADMINISTRADOR['clave'] ?>" <?= ($usuario->id_rol == ROL_ADMINISTRADOR['clave']) ? 'selected' : '' ?>>
                        <?= ROL_ADMINISTRADOR['rol'] ?>
                    </option>
                    <option value="<?= ROL_OPERADOR['clave'] ?>" <?= ($usuario->id_rol == ROL_OPERADOR['clave']) ? 'selected' : '' ?>>
                        <?= ROL_OPERADOR['rol'] ?>
                    </option>
                    <option value="<?= ROL_CLIENTE['clave'] ?>" <?= ($usuario->id_rol == ROL_CLIENTE['clave']) ? 'selected' : '' ?>>
                        <?= ROL_CLIENTE['rol'] ?>
                    </option>
                </select>
            </div>

            <div class="card-footer form-actions">
                <a href="<?= route_to('usuarios') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Guardar Cambios
                </button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
