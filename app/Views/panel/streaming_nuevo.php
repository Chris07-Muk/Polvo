<?= $this->extend('plantillas/panel_base') ?>

<?= $this->section('css') ?>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F3F4F6;
        color: #1f2937;
    }

    .card {
        border-radius: 14px;
        background-color: #ffffff;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        padding: 30px;
        border: none;
    }

    h4 {
        color: #0ea5e9;
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 25px;
    }

    .form-group label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control,
    .form-control-file,
    select,
    textarea {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 14px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus,
    select:focus,
    textarea:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 0.15rem rgba(14, 165, 233, 0.25);
    }

    .btn {
        border-radius: 10px;
        font-weight: 500;
        padding: 10px 22px;
        transition: all 0.25s ease;
    }

    .btn-success {
        background-color: #10b981;
        color: white;
        border: none;
    }

    .btn-success:hover {
        background-color: #059669;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #6b7280;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #4b5563;
        transform: translateY(-1px);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card">
            <h4 class="text-center"><i class="fas fa-clapperboard me-2"></i>Registrar Nuevo Título</h4>

            <?= form_open_multipart(route_to('guardar_streaming')) ?>

            <div class="form-group">
                <label for="nombre">Nombre del título</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej. Stranger Things" required>
            </div>

            <div class="form-group">
                <label for="fecha_lanzamiento">Fecha de lanzamiento original</label>
                <input type="date" name="fecha_lanzamiento" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="duracion">Duración estimada</label>
                <input type="time" name="duracion" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="temporadas">Cantidad de temporadas</label>
                <input type="number" name="temporadas" class="form-control" min="1" required>
            </div>

            <div class="form-group">
                <label for="clasificacion">Clasificación por edad</label>
                <select name="clasificacion" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="AA">AA - Infantil</option>
                    <option value="A">A - Todo Público</option>
                    <option value="B">B - Mayores de 12</option>
                    <option value="B15">B15 - Mayores de 15</option>
                    <option value="C">C - Mayores de 18</option>
                    <option value="D">D - Solo Adultos</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sipnosis">Sinopsis</label>
                <textarea name="sipnosis" class="form-control" rows="4" placeholder="Resumen del contenido..." required></textarea>
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
                <label for="caratula_streaming">Imagen de carátula</label>
                <input type="file" name="caratula_streaming" class="form-control-file" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="trailer_streaming">Tráiler en video</label>
                <input type="file" name="trailer_streaming" class="form-control-file" accept="video/*" required>
            </div>

            <div class="form-group mt-4 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
                <a href="<?= route_to('streaming') ?>" class="btn btn-secondary ms-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
