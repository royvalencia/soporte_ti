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
                    pattern="^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s\-\.]?\d{3}[\s\-\.]?\d{4}$"
                    aria-label="Telefono/Celular"
                />
            </div>
            <div class="col-sm-6">
                <label class="col-sm-1 col-form-label">Extensión</label>
                <input
                    id="extension"
                    name="extension"
                    type="text"
                    placeholder=" Ej. 123456"
                    class="form-control"
                    pattern="^[0-9]{1,6}$"
                    aria-label="Extensión"
                />
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
            />
        </div>

        <div class="form-group">
            <label class="col-sm-1 col-form-label">Dependencia</label>
            <?= $this->Form->control('dependencia_id', [
                'options' => $dependencias,
                'empty' => 'Seleccione una dependencia',
                'class' => 'form-control',
                'label' => false
            ]) ?>
        </div>
        <div class="form-group">
            <label class="col-sm-1 col-form-label">Direccion</label>
            <?= $this->Form->control('direccione_id', [
                'options' => $direcciones,
                'empty' => 'Seleccione una dirección',
                'class' => 'form-control',
                'label' => false
            ]) ?>
        </div>
        <div class="form-group">
            <label class="col-sm-7 col-form-label">Ubicación Física</label>
            <input
                id="ubicacion_fisica"
                name="ubicacion_fisica"
                type="text"
                placeholder="Ingrese su Ubicación Física"
                class="form-control"
                aria-label="Ubicación Física"
            />
        </div>
        <div class="form-group">
            <label class="col-sm-1 col-form-label">Edificio</label>
            <input
                id="edificio"
                name="edificio"
                type="text"
                placeholder="Ingrese su Edificio"
                class="form-control"
                aria-label="Edificio"
            />
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
            <?= $this->Form->error('email', ['escape' => false]) ?>
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
