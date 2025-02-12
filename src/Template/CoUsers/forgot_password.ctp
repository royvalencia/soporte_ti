<div class="passwordBox animated fadeInDown">
    <?php echo $this->Form->create('',array('url' => array('action'=>'forgotPassword'),'class'=>'m-t', 'role'=>'form'));?>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox-content">
                <h2 class="font-bold text-center">Recuperar Contraseña</h2>
                <p class="text-left">Ingrese el Correo para Recuperar su Contraseña </p>
                <br>
                <div class="form-group">
                    <input type="email"  name="email" id="email" class="form-control" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-group">
                    <?php
                    echo $this->Flash->render('success');

                    echo $this->Flash->render('error');
                    ?>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary block full-width m-b">Enviar Correo</button>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end();?>
</div>

