<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: none;
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
        font-size: 1.4rem;
        margin: 0;
    }

    .form-control, select {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 0.15rem rgba(79, 70, 229, 0.25);
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-check-label {
        margin-left: 5px;
    }

    .form-check {
        margin-bottom: 10px;
    }

    .preview-img {
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        border: 2px solid #E5E7EB;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-warning {
        background-color: #F59E0B;
        border: none;
        color: white;
    }

    .btn-warning:hover {
        background-color: #D97706;
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
        background-color: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        padding: 20px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-edit mr-2"></i>Editar Cliente</h3>
                    </div>

                    <?= form_open_multipart(route_to('cliente_actualizar', $cliente->id_usuario), ['id' => 'form-cliente-editar']) ?>
                    <div class="card-body">

                        <!-- Imagen de perfil -->
                        <div class="text-center mb-4">
                            <img id="preview_img" 
                                 src="<?= base_url('perfiles/' . ($cliente->imagen_usuario ?? 'cliente.png')) ?>" 
                                 alt="Imagen perfil"
                                 class="preview-img" width="130" height="130">
                        </div>

                        <div class="form-group">
                            <label for="foto_perfil">Cambiar Foto de perfil</label>
                            <input type="file" name="foto_perfil" id="foto_perfil" class="form-control"
                                   accept=".jpg, .jpeg, .png" onchange="previewImage()">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
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
                                <input class="form-check-input" type="radio" name="sexo" id="sexo_masculino" value="1"
                                       <?= $cliente->sexo_usuario == 1 ? 'checked' : '' ?> required>
                                <label class="form-check-label" for="sexo_masculino">Masculino</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo_femenino" value="2"
                                       <?= $cliente->sexo_usuario == 2 ? 'checked' : '' ?> required>
                                <label class="form-check-label" for="sexo_femenino">Femenino</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" value="<?= esc($cliente->email_usuario) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Nueva contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                        </div>

                        <div class="form-group">
                            <label for="repassword">Repetir contraseña</label>
                            <input type="password" name="repassword" class="form-control" placeholder="Repite la contraseña">
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <a href="<?= route_to('clientes') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning ml-2">
                            <i class="fas fa-save mr-1"></i> Actualizar Cliente
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
