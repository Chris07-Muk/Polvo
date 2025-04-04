<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    .card {
        background-color: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
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
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 6px;
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

    .form-check-input {
        margin-right: 8px;
    }

    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
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
        background-color: #ef4444;
        border: none;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #dc2626;
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

    .preview-img {
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #d1d5db;
        width: 130px;
        height: 130px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
                        <h3 class="card-title"><i class="fas fa-circle-user"></i> Registrar Cliente</h3>
                    </div>

                    <?= form_open_multipart(route_to('cliente_guardar'), ['id' => 'form-cliente']) ?>
                    <div class="card-body">
                        <div class="row">
                            <!-- Foto de perfil -->
                            <div class="col-md-4 text-center mb-4">
                                <img id="preview_img" src="<?= base_url('perfiles/cliente.png') ?>" alt="Imagen perfil"
                                     class="preview-img">
                                <div class="form-group mt-3">
                                    <label for="foto_perfil">Foto de perfil</label>
                                    <input type="file" name="foto_perfil" id="foto_perfil" class="form-control mt-1"
                                           accept=".jpg, .jpeg, .png" onchange="previewImage()">
                                </div>
                            </div>

                            <!-- Formulario -->
                            <div class="col-md-8">
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
                                    <label>Sexo</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="1" required>
                                        <label class="form-check-label" for="sexo_m">Masculino</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="2" required>
                                        <label class="form-check-label" for="sexo_f">Femenino</label>
                                    </div>
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
                                    <label for="repassword">Repetir Contraseña</label>
                                    <input type="password" name="repassword" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="<?= route_to('clientes') ?>" class="btn btn-secondary">
                            <i class="fas fa-circle-xmark"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-floppy-disk"></i> Registrar Cliente
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
