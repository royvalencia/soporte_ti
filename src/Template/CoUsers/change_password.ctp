<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo __('Perfil del Usuario');?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-title">
                    <h3><?= __('Imagen de Perfil'); ?></h3>
                </div>
                <div class="ibox-content profile-content">
                    <?php if (!empty($Auth['image'])): ?>
                        <?= $this->Html->image('/upload/avatar/' . $Auth['image'], [
                            'alt' => 'Imagen de Perfil',
                            'class' => 'profile-pic',
                            'style' => 'width: 200px; height: auto; margin: 0 auto; display: block;'
                        ]); ?>
                    <?php else: ?>
                        <p><?= __('No has subido una imagen de perfil todavía.'); ?></p>
                    <?php endif; ?>
                    <!-- Formulario para subir imagen -->
                    <?= $this->Form->create($user ,[
                        'url' => ['action' => 'upload-image'],
                        'type'=> 'file',
                        'class' => 'form-horizontal'
                    ]); ?>
                    <?= $this->Form->input('upload',[
                        'type' => 'file',
                        'label' => 'Seleccionar Imagen',
                        'class' => 'form-control',
                        'required' => 'required',
                        'arial-label' => 'Selecciona tu imagen de perfil'
                    ]); ?>
                    <br>
                    <?= $this->Form->button(
                        __('<i class="fa fa-check-circle"></i> Subir Imagen'),
                        [
                            'type'=>'submit',
                            'class'=>'btn btn-primary',
                            'escape'=>false,
                        ]
                    );?>
                    <?php if( !empty($Auth['image'])): ?>
                    <?= $this->Html->link(
                        __('<i class="fa fa-trash-o"></i> Eliminar Imagen'),
                        ['action' => 'remove-img'],
                        [
                            'class'=>'btn  btn-danger',
                            'escape'=>false,
                            'role'=>'button',
                            'confirm' => __('¿Seguro que desea eliminar la imagen de perfil?')
                        ]
                    ); ?>
                    <?php endif; ?>
                    <?= $this->Form->end() ; ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>Cambiar contraseña de <?= $Auth['nombre']; ?></h3>
                </div>
                <div class="ibox-content">
                    <div>
                        <?= $this->Form->create($user) ?>
                        <div class="form-group row">
                            <?= $this->Form->input("old_password", array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Contraseña Anterior'),'size' => 20,'type'=>'password','class'=>'form-control','required'=>true)); ?>
                        </div>
                        <div class="form-group row">
                            <?= $this->Form->input('password1', array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Nueva Contraseña'),'size' =>20,'type'=>'password','class'=>'form-control','required'=>true)); ?>
                        </div>
                        <div class="form-group row">
                            <?= $this->Form->input('password2', array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Confirmar Nueva Contraseña'),'size' =>20,'type'=>'password','class'=>'form-control','required'=>true)); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-offset-4 col-lg-8" >
                                <?= $this->Form->button(__('<i class="fa fa-check-circle"></i> Cambiar Contraseña'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false)); ?>
                            </div>
                        </div>
                        <?= $this->Form->end() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h3><?= __("Cambiar Datos de Usuario") ?></h3>
                </div>
                <div class="ibox-content">
                    <div>
                        <?= $this->Form->create($user ,[
                            'url' => ['action' => 'change-info'],
                            'type'=> 'post',
                            'class' => 'form-horizontal'
                        ]); ?>
                        <div class="form-group row">
                            <?= $this->Form->input("nombre", array(
                                'label'=>array(
                                    'class'=>'col-sm-5 control-label',
                                    'text'=>'Nombre Completo'
                                ),
                                'type'=>'text',
                                'class'=>'form-control',
                                'required'=>true
                            )); ?>
                        </div>
                        <div class="form-group row">
                            <?= $this->Form->input("telefono", array(
                                'label'=>array(
                                    'class'=>'col-sm-5 control-label',
                                    'text'=>'Numero de Telefono'
                                ),
                                'type'=>'tel',
                                'class'=>'form-control',
                                'required'=>true
                            )); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-offset-3 col-lg-6" >
                                <?= $this->Form->button(__('<i class="fa fa-check-circle"></i> Cambiar Datos Usuario'),array(
                                    'type'=>'submit',
                                    'class'=>'btn btn-primary',
                                    'div'=>false,
                                    'escape'=>false
                                )); ?>
                            </div>
                        </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
</div>
