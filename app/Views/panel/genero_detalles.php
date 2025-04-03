<?= $this->extend('plantillas/panel_base') ?>

<!-- RENDER css -->
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
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
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

    .form-control, textarea, select {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, textarea:focus, select:focus {
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
        background-color: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        padding: 20px;
    }
</style>
<?= $this->endSection() ?>

<!-- RENDER CONTENT -->
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tags mr-2"></i> Detalles del Género
                        </h3>
                    </div>

                    <?= form_open(route_to('actualizar_genero', $genero->id_genero), ["id" => "formulario-detalles-genero"]) ?>
                    <div class="card-body">

                        <!-- Nombre del Género -->
                        <div class="form-group">
                            <label for="nombre">
                                <i class="fas fa-tag mr-1"></i> Nombre del Género
                            </label>
                            <?= form_input([
                                "type" => "text",
                                "class" => "form-control",
                                "name" => "nombre",
                                "id" => "nombre",
                                "value" => $genero->nombre_genero,
                                "placeholder" => "Nombre del género",
                                "required" => true
                            ]) ?>
                        </div>

                        <!-- Descripción del Género -->
                        <div class="form-group">
                            <label for="descripcion">
                                <i class="fas fa-align-left mr-1"></i> Descripción
                            </label>
                            <?= form_textarea([
                                "class" => "form-control",
                                "name" => "descripcion",
                                "id" => "descripcion",
                                "rows" => "4",
                                "placeholder" => "Descripción del género",
                                "required" => true
                            ], $genero->descripcion_genero) ?>
                        </div>

                        <!-- Estatus del Género -->
                        <div class="form-group">
                            <label for="estatus">
                                <i class="fas fa-toggle-on mr-1"></i> Estatus
                            </label>
                            <select name="estatus" id="estatus" class="form-control" required>
                                <option value="1" <?= $genero->estatus_genero == 1 ? 'selected' : '' ?>>Activo</option>
                                <option value="-1" <?= $genero->estatus_genero == -1 ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Footer con botones -->
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Actualizar
                        </button>
                        <a href="<?= route_to('generos') ?>" class="btn btn-danger ml-2">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                    </div>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<!-- RENDER JS -->
<?= $this->section('js') ?>
<script>
    document.getElementById("formulario-detalles-genero").addEventListener("submit", function(e){
        const nombre = document.getElementById("nombre").value.trim();
        const descripcion = document.getElementById("descripcion").value.trim();

        if(nombre === "" || descripcion === "") {
            e.preventDefault();
            alert("Todos los campos son obligatorios.");
        }
    });
</script>
<?= $this->endSection() ?>
