<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F1F5F9;
        color: #0f172a;
    }

    .card {
        border-radius: 14px;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
        border: none;
        background-color: #ffffff;
    }

    .card-header {
        background: linear-gradient(135deg, #0f766e 0%, #0e7490 100%);
        color: white;
        padding: 22px;
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
        display: flex;
        align-items: center;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.5rem;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .card-title i {
        margin-right: 10px;
    }

    .form-group label {
        font-weight: 500;
        color: #334155;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
    }

    .form-group label i {
        margin-right: 6px;
        color: #0f766e;
    }

    .form-control,
    textarea,
    select {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 15px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus,
    textarea:focus,
    select:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 0.12rem rgba(14, 165, 233, 0.25);
    }

    .card-footer {
        background-color: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 20px;
        text-align: right;
    }

    .btn {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.2s ease;
        font-size: 0.95rem;
    }

    .btn-primary {
        background-color: #0ea5e9;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0284c7;
        transform: translateY(-1px);
    }

    .btn-danger {
        background-color: #f87171;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #ef4444;
        transform: translateY(-1px);
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
                            <i class="fas fa-pen-nib"></i> Editar Género
                        </h3>
                    </div>

                    <?= form_open(route_to('actualizar_genero', $genero->id_genero), ["id" => "formulario-detalles-genero"]) ?>
                    <div class="card-body">

                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="nombre">
                                <i class="fas fa-font"></i> Nombre del Género
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= esc($genero->nombre_genero) ?>" placeholder="Ej. Misterio, Romance..." required>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group">
                            <label for="descripcion">
                                <i class="fas fa-align-justify"></i> Descripción
                            </label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="Describe brevemente el género..." required><?= esc($genero->descripcion_genero) ?></textarea>
                        </div>

                        <!-- Estatus -->
                        <div class="form-group">
                            <label for="estatus">
                                <i class="fas fa-toggle-on"></i> Estatus
                            </label>
                            <select name="estatus" id="estatus" class="form-control" required>
                                <option value="1" <?= $genero->estatus_genero == 1 ? 'selected' : '' ?>>Activo</option>
                                <option value="-1" <?= $genero->estatus_genero == -1 ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Guardar Cambios
                        </button>
                        <a href="<?= route_to('generos') ?>" class="btn btn-danger ml-2">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
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
    document.getElementById("formulario-detalles-genero").addEventListener("submit", function(e){
        const nombre = document.getElementById("nombre").value.trim();
        const descripcion = document.getElementById("descripcion").value.trim();
        if(nombre === "" || descripcion === "") {
            e.preventDefault();
            alert("Por favor, completa todos los campos.");
        }
    });
</script>
<?= $this->endSection() ?>
