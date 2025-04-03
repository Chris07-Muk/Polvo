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

    .form-text {
        font-size: 0.85rem;
        color: #6B7280;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card">
            <h4 class="text-center"><i class="fas fa-edit mr-2"></i>Editar Video</h4>

            <?= form_open_multipart(route_to('actualizar_video', $video->id_video)) ?>

            <div class="form-group">
                <label for="video">Archivo de Video <small>(dejar vacío para mantener el actual)</small></label>
                <input type="file" name="video" class="form-control-file" accept="video/*">
                <small class="form-text">Archivo actual: <?= esc($video->video) ?></small>
            </div>

            <div class="form-group">
                <label for="nombre_temporada">Nombre de Temporada</label>
                <input type="text" name="nombre_temporada" class="form-control" value="<?= esc($video->nombre_temporada) ?>" required>
            </div>

            <div class="form-group">
                <label for="video_temporada">Número de Temporada</label>
                <input type="number" name="video_temporada" class="form-control" value="<?= esc($video->video_temporada) ?>" min="1" required>
            </div>

            <div class="form-group">
                <label for="capitulo_temporada">Número de Capítulo</label>
                <input type="number" name="capitulo_temporada" class="form-control" value="<?= esc($video->capitulo_temporada) ?>" min="1" required>
            </div>

            <div class="form-group">
                <label for="descripcion_capitulo_temporada">Descripción del Capítulo</label>
                <textarea name="descripcion_capitulo_temporada" rows="4" class="form-control" required><?= esc($video->descripcion_capitulo_temporada) ?></textarea>
            </div>

            <div class="form-group">
                <label for="id_streaming">Título (Streaming) Asociado</label>
                <select name="id_streaming" class="form-control" required>
                    <option value="">Seleccione un título</option>
                    <?php foreach ($streamings as $item): ?>
                        <option value="<?= $item->id_streaming ?>" <?= ($video->id_streaming == $item->id_streaming) ? 'selected' : '' ?>>
                            <?= esc($item->nombre_streaming) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group mt-4 text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Actualizar Video
                </button>
                <a href="<?= route_to('videos') ?>" class="btn btn-secondary ml-2">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
