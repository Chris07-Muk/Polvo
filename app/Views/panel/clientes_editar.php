<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 6px 16px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .card-header {
        background-color: #f3f4f6;
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.15);
        outline: none;
    }

    .form-group label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }

    .form-check-input {
        margin-right: 8px;
    }

    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .preview-img {
        object-fit: cover;
        border-radius: 50%;
        width: 130px;
        height: 130px;
        border: 3px solid #d1d5db;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .btn {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-warning {
        background-color: #f59e0b;
        border: none;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #d97706;
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

    .card-footer {
        background-color: #f9fafb;
        padding: 20px 24px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-pen"></i> Editar Cliente</h3>
                    </div>

                    <?= form_open_multipart(route_to('cliente_actualizar', $cliente->id_usuario), ['id' => 'form-cliente-editar']) ?>
                    <div class="card-body">
                        <div class="row">
                            <!-- Imagen -->
                            <div class="col-md-4 text-center mb-4">
                                <img id="preview_img" 
                                     src="<?= base_url('perfiles/' . ($cliente->imagen_usuario ?? 'cliente.png')) ?>" 
                                     alt="Imagen perfil"
                                     class="preview-img">
                                <div class="form-group mt-3">
                                    <label for="foto_perfil">Cambiar foto</label>
                                    <input type="file" name="foto_perfil" id="foto_perfil" class="form-control"
                                           accept=".jpg, .jpeg, .png" onchange="previewImage()">
                                </div>
                            </div>

                            <!-- Formulario -->
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nombre">Nombre(s)</label>
                                    <input type="text" name="nombre" class="form-control" value="<?= esc($cliente->nombre_usuario) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="apellido_paterno">Apellido paterno</label>
                                    <input type="text" name="apellido_paterno" class="form-control" value="<?= esc($cliente->ap_usuario) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="apellido_materno">Apellido materno</label>
                                    <input type="text" name="apellido_materno" class="form-control" value="<?= esc($cliente->am_usuario) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Sexo</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="1" <?= $cliente->sexo_usuario == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="sexo_m">Masculino</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="2" <?= $cliente->sexo_usuario == 2 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="sexo_f">Femenino</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                    <input type="email" name="email" class="form-control" value="<?= esc($cliente->email_usuario) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Nueva contraseña (opcional)</label>
                                    <input type="password" name="password" class="form-control" placeholder="Dejar en blanco si no se desea cambiar">
                                </div>

                                <div class="form-group">
                                    <label for="repassword">Repetir contraseña</label>
                                    <input type="password" name="repassword" class="form-control" placeholder="Confirma la nueva contraseña">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="<?= route_to('clientes') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-floppy-disk"></i> Actualizar Cliente
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function previewImage() {
        const file = document.getElementById('foto_perfil').files[0];
        const preview = document.getElementById('preview_img');
        if (file) {
            const reader = new FileReader();
            reader.onload = e => preview.src = e.target.result;
            reader.readAsDataURL(file);
        }
    }
</script>
<?= $this->endSection() ?>
