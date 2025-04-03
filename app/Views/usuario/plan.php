<?= $this->extend("plantillas/portal_base") ?>

<?= $this->section("titulo") ?>
    <?= esc($titulo_pagina) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5 mb-5 text-white">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-4">Mi Plan Actual</h2>

            <?php if (!empty($plan_usuario)): ?>
                <div class="card bg-dark text-white border-0 shadow-lg rounded p-4">
                    <h4 class="text-warning"><?= esc($plan_usuario->nombre_plan) ?></h4>
                    <p><strong>Precio:</strong> $<?= esc($plan_usuario->precio_plan) ?></p>
                    <p><strong>Fecha de inicio:</strong> <?= esc($plan_usuario->fecha_registro_plan) ?></p>
                    <p><strong>Fecha de fin:</strong> <?= esc($plan_usuario->fecha_fin_plan) ?></p>
                    <p><strong>Días restantes:</strong> <?= esc($plan_usuario->dias_activo) ?> día(s)</p>

                    <!-- Estado del pago -->
                    <?php if (isset($estatus_pago) && $estatus_pago !== null): ?>
                        <div class="mt-3">
                            <?php if ($estatus_pago == 0): ?>
                                <div style="background-color: #ffc107; color: #000; padding: 8px 16px; border-radius: 6px; display: inline-block;">
                                    Pago pendiente
                                </div>
                            <?php elseif ($estatus_pago == 1): ?>
                                <div style="background-color: #28a745; color: #fff; padding: 8px 16px; border-radius: 6px; display: inline-block;">
                                    Pago aceptado
                                </div>
                            <?php elseif ($estatus_pago == -1): ?>
                                <div style="background-color: #dc3545; color: #fff; padding: 8px 16px; border-radius: 6px; display: inline-block;">
                                    Pago rechazado
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    No tienes un plan contratado aún.
                    <br>
                    <a href="<?= route_to('planes_disponibles') ?>" class="btn btn-warning mt-3">Ver planes disponibles</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
