<?= $this->extend('plantillas/panel_base') ?>

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
        background-color: #fff;
        padding: 25px;
    }

    h4 {
        font-weight: 600;
        color: #4F46E5;
        margin-bottom: 25px;
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control, .form-control-file, select, textarea {
        border-radius: 8px;
        border: 1px solid #CBD5E0;
        padding: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus, select:focus, textarea:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 0.15rem rgba(79, 70, 229, 0.2);
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-success {
        background-color: #4F46E5;
        border: none;
        color: white;
    }

    .btn-success:hover {
        background-color: #4338CA;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card">
            <h4 class="text-center"><i class="fas fa-film mr-2"></i>Nuevo Streaming</h4>

            <?= form_open_multipart(route_to('guardar_streaming')) ?>

            <div class="form-group">
                <label for="nombre">Nombre del título</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha_lanzamiento">Fecha de lanzamiento</label>
                <input type="date" name="fecha_lanzamiento" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="duracion">Duración</label>
                <input type="time" name="duracion" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="temporadas">Temporadas</label>
                <input type="number" name="temporadas" class="form-control" min="1" required>
            </div>

            <div class="form-group">
                <label for="clasificacion">Clasificación</label>
                <select name="clasificacion" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="AA">AA - Infantil</option>
                    <option value="A">A - Todo Público</option>
                    <option value="B">B - Mayores de 12</option>
                    <option value="B15">B15 - Mayores de 15</option>
                    <option value="C">C - Mayores de 18</option>
                    <option value="D">D - Exclusiva Adultos</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sipnosis">Sinopsis</label>
                <textarea name="sipnosis" class="form-control" rows="4" placeholder="Sinopsis del título..." required></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_estreno">Fecha de estreno en plataforma</label>
                <input type="date" name="fecha_estreno" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="id_genero">Género</label>
                <select name="id_genero" class="form-control" required>
                    <option value="">Seleccione un género</option>
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?= $genero->id_genero ?>"><?= esc($genero->nombre_genero) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="caratula_streaming">Carátula (imagen)</label>
                <input type="file" name="caratula_streaming" class="form-control-file" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="trailer_streaming">Tráiler (video)</label>
                <input type="file" name="trailer_streaming" class="form-control-file" accept="video/*" required>
            </div>

            <div class="form-group mt-4 text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Streaming
                </button>
                <a href="<?= route_to('streaming') ?>" class="btn btn-secondary ml-2">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
