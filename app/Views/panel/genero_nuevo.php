<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<!-- DISEÑO UNIFICADO -->
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
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        color: white;
        padding: 20px;
        border-bottom: none;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 0;
    }

    .form-control, textarea {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, textarea:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 0.15rem rgba(79, 70, 229, 0.2);
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
        background-color: #4F46E5;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #4338CA;
        transform: translateY(-1px);
    }

    .btn-danger {
        background-color: #EF4444;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #DC2626;
        transform: translateY(-1px);
    }

    .card-footer {
        background-color:rgb(62, 122, 182);
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
                        <h3 class="card-title">
                            <i class="fas fa-film mr-2"></i> Nuevo Género
                        </h3>
                    </div>

                    <!-- Formulario de registro -->
                    <?= form_open(route_to('guardar_genero'), ['id' => 'formulario-genero']) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre_genero">
                                <i class="fas fa-tag mr-1"></i> Nombre del género
                            </label>
                            <input type="text" name="nombre_genero" id="nombre_genero" class="form-control" placeholder="Ej. Acción, Comedia..." required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion_genero">
                                <i class="fas fa-align-left mr-1"></i> Descripción
                            </label>
                            <textarea name="descripcion_genero" id="descripcion_genero" class="form-control" rows="4" placeholder="Escribe una breve descripción del género..." required></textarea>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="<?= route_to('generos') ?>" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary ml-2">
                            <i class="fas fa-save mr-1"></i> Guardar género
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>