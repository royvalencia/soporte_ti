<div class="ibox-content">
    <p class="text-center"><b style="font-size: 1.5rem;"> Ingrese su Contraseña.</b></p>
    <!-- Formulario Correo -->
    <?php echo $this->Form->create('',[
        'url' => ['action'=>'loginpaso2'],
        'class'=>'m-t',
        'role'=>'form'
    ]);
    //echo $this->Form->create();
    echo $this->Form->hidden('login', ['value' => $login]);

    ?>
    <div class="form-group  has-feedback">
        <input
            id="password"
            name="password"
            type="password"
            placeholder="Contraseña"
            class="form-control"
            required
            aria-label="Contraseña"
        />
        <i class="form-control-feedback fa fa-lock fa-lg"  aria-hidden="true" style="top:8px;color:#a5b4c8"></i>
    </div>
    <div class="row">
        <?php echo $this->Flash->render('error'); ?>
    </div>
    <div class="form-group text-center">
        <?php echo $this->Form->button('Iniciar sesión', ['class' => 'btn btn-primary']); ?>

    </div>
    <?php echo $this->Form->end(); ?>
    <br><br>
    <p class="text-muted text-left">
        <a href="<?= $this->Url->build(['controller' => 'CoUsers','action' => 'forgotPassword']) ?>"><small>Recuperar Contraseña</small></a>
    </p>
</div>
