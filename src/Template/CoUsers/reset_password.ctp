<div class="passwordBox animated fadeInDown">
    <?= $this->Form->create(null) ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <h2 class="font-bold text-center">Restablecer Contraseña</h2>
                <p class="text-left">Ingrese su nueva Contraseña </p>
                <br>
                <div class="form-group">
                    <?= $this->Form->control('password', [
                        'class' => "form-control",
                        'type' => 'password',
                        'label' => 'Nueva Contraseña',
                        'required' => true
                    ]) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('password_confirm', [
                        'class' => "form-control",
                        'type' => 'password',
                        'label' => 'Confirmar Contraseña',
                        'required' => true
                    ]) ?>
                </div>
                <?= $this->Form->button('Restablecer Contraseña', ['class' => 'btn btn-primary block full-width m-b']) ?>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
