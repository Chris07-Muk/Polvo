<!-- Importartar las depedencias -->

<?= $this->extend("plantillas/portal_base") ?>

<!-- Titulo -->
<?= $this->section('titulo') ?>
<?= $titulo_pagina ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<main>
<div class="wrapper_pagos">
    <?= form_open('validar_pago', ['id' => 'form-pago']) ?>
    <div>
        <label for="name">Nombre del titular</label>
        <?= form_input([
            'type' => 'text',
            'id' => 'name',
            'name' => 'titular',
            'class' => 'input_pg',
            'autocomplete' => 'cc-name',
            'required' => true
        ]) ?>
    </div>
    <div class="card-number">
        <label>Numero de tarjeta</label>
        <?= form_input([
            'type' => 'text',
            'id' => 'card-number',
            'name' => 'num_tarjeta',
            'class' => 'input_pg',
            'inputmode' => 'numeric',
            'autocomplete' => 'cc-number',
            'pattern' => '[0-9]+',
            'maxlength' => '16',
            'required' => true
        ]) ?>
    </div>
    <div class="date-code">
        <div>
            <label for="expiry-date">Fecha de expiración</label>
            <?= form_input([
                'type' => 'text',
                'id' => 'expiry-date',
                'name' => 'fecha_exp',
                'class' => 'input_pg expiry-date',
                'autocomplete' => 'cc-exp',
                'placeholder' => 'MM/YY',
                'maxlength' => '5',
                'pattern' => '[0-9/]+',
                'required' => true
            ]) ?>
        </div>
        <div>
            <label for="security-code">CVV</label>
            <?= form_input([
                'type' => 'text',
                'id' => 'security-code',
                'name' => 'cvv',
                'class' => 'input_pg',
                'inputmode' => 'numeric',
                'maxlength' => '4',
                'minlength' => '3',
                'pattern' => '[0-9]+',
                'required' => true
            ]) ?>
        </div>
    </div>

    <br>
    <?= form_submit('btn-submit', 'MXN '.$precio_plan.'', ['class' => 'btn-submit']) ?>
    <?= form_close() ?>
</div>

    
</main>

<?= $this->endSection() ?>