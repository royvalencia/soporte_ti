 <p>Proporcione los datos solicitados.</p>

              <?php echo $this->Form->create('',array('url' => array('action'=>'login'),'class'=>'m-t', 'role'=>'form'));?>
                <div class="form-group  has-feedback">
                     <input id="login" name="login" type="text" placeholder="Nombre de Usuario" class="form-control" required>                      
                      <i class="form-control-feedback fa fa-user fa-lg"  aria-hidden="true" style="top:8px;color:#a5b4c8"></i>                
                    
                </div>
                <div class="form-group  has-feedback">
                    <input id="password" name="password" type="password" placeholder="Contraseña" class="form-control" required>
                   <i class="form-control-feedback fa fa-lock fa-lg"  aria-hidden="true" style="top:8px;color:#a5b4c8"></i>                
                </div>
                 <div class="row">
                    <?php  // echo $this->Session->flash('auth', array('element' => 'flash_error')); 
                            echo $this->Flash->render('auth',array('element'=>'Flash/login_auth'));
                            echo $this->Flash->render();
                    ?>                   
 </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Iniciar Sesión</button>
               
              
                 <?php
                     //echo $this->Html->link('<small>¿Olvidó su contraseña?</small>',array('action'=>'forget_pwd','controller'=>'co_users'),array('class'=>'','escape'=>false));
                 ?>
                             
                <?php
                     //echo $this->Html->link('Crear una  cuenta',array('controller'=>'registros','action'=>'prev_register'),array('class'=>'btn btn-sm btn-white btn-block'));
                 ?>
              <?php echo $this->Form->end();?>
              <br><br>
                <?php
                     //echo $this->Html->link('<small>Regresar a la página de Inicio</small>',array('action'=>'index','controller'=>'inicios'),array('class'=>'','escape'=>false));
                 ?> 
                


              
            
<script type="text/javascript" >
$(document).ready(function() {
    jQuery("#login").focus();
 });

 document.getElementById("login").focus();
</script>