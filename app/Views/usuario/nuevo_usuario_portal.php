<?= $this->extend("plantillas/portal_base") ?>

<?= $this->section("titulo") ?>
    Registro de Usuario
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<section style="background: linear-gradient(135deg, #0f0f1f, #1a1a2e); min-height: 100vh; padding: 4rem 2rem;">
    <div class="container">
        <div style="max-width: 600px; margin: 0 auto; background: rgba(30, 30, 58, 0.95); padding: 2rem; border-radius: 5;">
            <h2 class="text-center mb-4" style="color: #ffe600; font-family: 'Oswald', sans-serif;">Registrarse</h2>

            <form method="POST" action="<?= route_to('registrar_usuario_portal') ?>" enctype="multipart/form-data">
                <div style="margin-bottom: 1.2rem;">
                    <label class="form-label text-light" for="nombre">Nombre(s)</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" style="background: transparent; border: 1px solid #ffe600; color: white; display: block; width: 100%;" required>
                </div>

                <div style="margin-bottom: 1.2rem;">
                    <label class="form-label text-light" for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" style="background: transparent; border: 1px solid #ffe600; color: white; display: block; width: 100%;" required>
                </div>

                <div style="margin-bottom: 1.2rem;">
                    <label class="form-label text-light" for="apellido_materno">Apellido Materno</label>
                    <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" style="background: transparent; border: 1px solid #ffe600; color: white; display: block; width: 100%;" required>
                </div>

                <div style="margin-bottom: 1.2rem;">
                    <label class="form-label text-light">Sexo</label>
                    <select name="sexo" class="form-select" style="background: transparent; border: 1px solid #ffe600; color: white; display: block; width: 100%;" required>
                        <option value="" style="background: #1a1a2e;">Selecciona una opción</option>
                        <option value="1" style="background: #1a1a2e;">Masculino</option>
                        <option value="0" style="background: #1a1a2e;">Femenino</option>
                    </select>
                </div>
                <br>
                <div style="margin-bottom: 1.2rem;">
                    <label class="form-label text-light" for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" style="background: transparent; border: 1px solid #ffe600; color: white; display: block; width: 100%;" required>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label class="form-label text-light" for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" style="background: transparent; border: 1px solid #ffe600; color: white; display: block; width: 100%;" required>
                </div>

                <!-- Rol fijo oculto -->
                <input type="hidden" name="rol" value="58">

                <div class="text-center">
                    <button type="submit" class="btn btn-warning text-dark px-5 mt-3" style="border-radius: 30px; font-weight: bold; background: #ffe600; border: none;">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>