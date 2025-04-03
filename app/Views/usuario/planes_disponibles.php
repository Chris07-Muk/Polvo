<?= $this->extend("plantillas/portal_base") ?>

<?= $this->section("titulo") ?>
    Planes disponibles
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container mt-5 mb-5 text-white">
    <h2 class="mb-4">Planes Disponibles</h2>
    <div class="row">
        <?php if (!empty($planes_disponibles)): ?>
            <?php foreach ($planes_disponibles as $plan): ?>
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white border-0 shadow p-3">
                        <h4 class="text-warning"><?= esc($plan->nombre_plan) ?></h4>
                        <p><strong>Precio:</strong> $<?= esc($plan->precio_plan) ?></p>
                        <p><strong>Tipo:</strong> <?= esc($plan->tipo_plan) ?></p>
                        <p><strong>Límite:</strong> <?= esc($plan->cantidad_limite_plan) ?> contenidos</p>

                        <a href="<?= route_to('plan_contratar', $plan->id_plan) ?>" 
                           class="btn btn-warning mt-3">Contratar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>No hay planes activos en este momento.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
