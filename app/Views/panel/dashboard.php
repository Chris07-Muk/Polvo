<!-- IMPORTAR LA PLANTILLA -->
<?= $this->extend('plantillas/panel_base')?>

<!-- RENDER css -->
<?= $this->section('css')?>
<!-- daterangepicker -->
<link rel="stylesheet" href="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS. '/daterangepicker/daterangepicker.css')?>">
<?= $this->endSection()?>
<!-- RENDER css -->

<!-- RENDER CONTENT -->
<?= $this->section('content')?>
<section class="content">
    <div class="container-fluid">
        
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Título de muestra</h3>
                    </div>
                    <div class="card-body">
                        <p>Más contenido aleatorio para este panel</p>
                        <ul>
                            <li>Elemento de lista 1</li>
                            <li>Elemento de lista 2</li>
                            <li>Elemento de lista 3</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title">Otro título</h3>
                    </div>
                    <div class="card-body">
                        <p>Este es solo texto de relleno para verificar que el módulo funciona correctamente.</p>
                        <p>Proin ac quam et lectus vehicula porttitor. Cras dolor magna, tincidunt non lorem ac, gravida lobortis neque.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection()?>
<!-- RENDER CONTENT -->

<!-- RENDER js -->
<?= $this->section('js')?>
<!-- daterangepicker -->
<script src="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS. '/moment/moment.min.js')?>"></script>
<script src="<?= base_url(RECURSOS_PANEL_ADMIN_PLUGINS. '/daterangepicker/daterangepicker.js')?>"></script>
<?= $this->endSection()?>
<!-- RENDER js -->