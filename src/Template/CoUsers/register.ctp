<?php if (isset($coUser) && $coUser->getErrors()): ?>
    <div class="alert alert-danger">
        <ul>
        <?php foreach ($coUser->getErrors() as $campo => $errores): ?>
            <?php foreach ($errores as $error): ?>
                <li><?= h($campo) ?>: <?= h($error) ?></li>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <?php  echo $this->Html->image('logo_inicio.png', array('style'=>array('display:inline'),'class'=>array('img-responsive'))); ?>
        </div>
        <h3>Crear Cuenta</h3>
        <?php echo $this->Form->create('',[
            'url' => ['action'=>'register'],
            'class'=>'m-t',
            'role'=>'form'
        ]); ?>
        <div class="form-group">
            <label class="col-sm-7 col-form-label">Nombre Completo</label>
            <input
                id="nombre"
                name="nombre"
                type="text"
                placeholder="Ingrese su Nombre Completo"
                class="form-control"
                required
                aria-label="Nombre"
            />
            <?= $this->Form->error('nombre', ['class' => 'text-danger']) ?>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="col-sm-1 col-form-label">Teléfono</label>
                <input
                    id="telefono"
                    name="telefono"
                    type="tel"
                    placeholder=" Ej. 01234567890 000-000-0000"
                    class="form-control"
                    required
                    aria-label="Telefono/Celular"
                />
                <?= $this->Form->error('telefono', ['class' => 'text-danger']) ?>

            </div>
            <div class="col-sm-6">
                <label class="col-sm-1 col-form-label">Extensión</label>
                <input
                    id="extension"
                    name="extension"
                    type="text"
                    placeholder=" Ej. 123456"
                    class="form-control"
                    required
                    pattern="^[0-9]{1,6}$"
                    aria-label="Extensión"
                />
                <?= $this->Form->error('extension', ['class' => 'text-danger']) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-7 col-form-label">Correo Electrónico</label>
            <input
                id="email"
                name="email"
                type="email"
                placeholder="Ingrese su Correo Electrónico"
                class="form-control"
                required
                aria-label="Correo Electrónico"
                pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$"
            />
            <?= $this->Form->error('email', ['class' => 'text-danger']) ?>

        </div>

        <div class="form-group">
            <label class="col-sm-1 col-form-label">Dependencia</label>
            <?= $this->Form->control('dependencia_id', [
                'options' => $dependencias,
                'empty' => 'Seleccione una dependencia',
                'class' => 'form-control',
                'label' => false,
                'required' => true,
                'id' => 'dependencia_id'
            ]) ?>
            <?= $this->Form->error('dependencia_id', ['class' => 'text-danger']) ?>

        </div>

        <div class="form-group" id="dependencia_texto" style="display: none;">
            <label class="col-sm-6 col-form-label">** Especifique **</label>
            <input
                id="texto_dependencia"
                name="texto_dependencia"
                type="text"
                placeholder="Ingrese su Dependencia"
                class="form-control"
                aria-label="Dependencia"
            />
            <?= $this->Form->error('text_dependencia', ['class' => 'text-danger']) ?>

        </div>
        <div class="form-group">
            <label class="col-sm-1 col-form-label">Direccion</label>
            <?= $this->Form->control('direccione_id', [
                'options' => $direcciones,
                'empty' => 'Seleccione una dirección',
                'class' => 'form-control',
                'label' => false,
                'required' => true
            ]) ?>
            <?= $this->Form->error('direccion_id', ['class' => 'text-danger']) ?>

        </div>
        <div class="form-group">
            <label class="col-sm-6 col-form-label">Ubicación Física</label>
            <input
                id="ubicacion_fisica"
                name="ubicacion_fisica"
                type="text"
                placeholder="Ingrese su Ubicación Física"
                class="form-control"
                required
                aria-label="Ubicación Física"
            />
            <?= $this->Form->error('ubicacion_fisica', ['class' => 'text-danger']) ?>

        </div>
        <div class="form-group">
            <label class="col-sm-1 col-form-label">Edificio</label>
            <input
                id="edificio"
                name="edificio"
                type="text"
                placeholder="Ingrese su Edificio"
                class="form-control"
                required
                aria-label="Edificio"
            />
            <?= $this->Form->error('edificio', ['class' => 'text-danger']) ?>
        </div>
        <div class="form-group">
            <label class="col-sm-1 col-form-label">Contraseña</label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Ingrese una Contraseña"
                class="form-control"
                required
                aria-label="Contraseña"
                autocomplete="off"
            />
            <?= $this->Form->error('password', ['class' => 'text-danger']) ?>

        </div>
        <div class="form-group">
            <label class="col-sm-7 col-form-label">Repetir Contraseña</label>
            <input
                id="password_confirm"
                name="password_confirm"
                type="password"
                placeholder="Confirmar su Contraseña"
                class="form-control"
                required
                aria-label="Confirmar Contraseña"
                autocomplete="off"
            />
            <?= $this->Form->error('password_confirm', ['class' => 'text-danger']) ?>
        </div>
        <?php echo $this->Form->button('Crear Cuenta', ['class' => 'btn btn-success']); ?>

        <?php echo $this->Form->end();?>
        <br><br>
        <p class="text-muted text-center">
            <small>Ya tiene una Cuenta</small>
        </p>
        <?php
        echo $this->Html->link("Iniciar Sesión", array('controller' => 'CoUsers','action'=> 'login'), array( 'class' => 'btn btn-primary block full-width m-b'))
        ?>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('dependencia_id');
    var especifique = document.getElementById('dependencia_texto');

    select.addEventListener('change', function() {
        // Cambia '999' por el valor que debe activar el campo
        if (this.value == '2' || this.value == '3' || this.value == '4') {
            especifique.style.display = 'block';
            document.getElementById('texto_dependencia').required = true;
        } else {
            especifique.style.display = 'none';
            document.getElementById('texto_dependencia').required = false;
        }
    });
});
</script>