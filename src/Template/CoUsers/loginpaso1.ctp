<div class="ibox-content">
    <p class="text-center"><b style="font-size: 1.5rem;"> Ingrese su Correo Electrónico.</b></p>
    <!-- Formulario Correo -->
    <?php echo $this->Form->create('',[
        'url' => ['action'=>'loginpaso1'],
        'class'=>'m-t',
        'role'=>'form'
    ]); ?>
    <div class="form-group has-feedback">
        <input
            id="login"
            name="login"
            type="text"
            placeholder="Correo Electrónico"
            class="form-control"
            required
            autofocus
            aria-label="Correo Electrónico"
        />
        <i class="form-control-feedback fa fa-user fa-lg"  aria-hidden="true" style="top:8px;color:#a5b4c8"></i>
    </div>
    <div class="row">
        <?php  echo $this->Flash->render('error');  ?>
    </div>
    <div class="form-group text-center">
        <?php echo $this->Form->button('Siguiente', ['class' => 'btn btn-primary block full-width m-b']); ?>
    </div>
    <?php echo $this->Form->end(); ?>
    <br><br>
    <p class="text-muted text-center">
        <small>¿No tienes una cuenta?</small>
    </p>
    <?php
        echo $this->Html->link("Crear Cuenta", array('controller' => 'CoUsers','action'=> 'register'), array( 'class' => 'btn btn-primary block full-width m-b'))
    ?>

</div>
