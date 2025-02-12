<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$left_side_bar_css ='';
$content_wrapper_css ='';
$js_toggle_css ='  ';  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo 'VINCULA - ICATQR' ?>
        </title>
           
        <?php
        echo $this->Html->meta('icon');
            
         echo $this->Html->css('inspinia/bootstrap.min');    
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('inspinia/plugins/toastr/toastr.min');
        echo $this->Html->css('inspinia/animate');
        echo $this->Html->css('inspinia/style-blue');
        echo $this->Html->css('inspinia/custom'); //EStilos propios
    
     echo $this->Html->script('inspinia/jquery-2.1.1.js');
        echo $scripts_for_layout;      
        ?>
       
    </head>
    <body class="md-skin fixed-sidebar fixed-nav   body-small pace-done ">
<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <span>
                            <img alt="image" class="img-circle" src="<?php echo  $this->request->webroot .'img/user.png' ?>">
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $Auth['nombre'] ?></strong>
                             </span> <span class="text-muted text-xs block">Usuario <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                 <li><?php        
                                      echo $this->Html->link(' Manuales',
                                                             array('plugin'=>'','controller'=>'ayudas','action'=>'index')
                                                             ,array('title'=>'Manuales','escape'=>false));
                                 ?>
                                 </li>
                                  <li>
                                     <?php 
                                     echo $this->Html->link(' Cambiar Contraseña',
                                     array('plugin'=>'','controller'=>'co_users','action'=>'changePassword')
                                     ,array('title'=>'Cambiar  la Contraseña de Acceso','escape'=>false));
                                     ?>
                                  </li>
                                 <li class="divider"></li>
                                    <li>
                                    <?php        
                                    echo $this->Html->link(' Cerrar Sesión',
                                         array('plugin'=>'','controller'=>'co_users','action'=>'logout')
                                         ,array('title'=>'Salir del Sistema','escape'=>false));
                                    ?>
                                    </li>
                            </ul>
                    </div>
                    <div class="logo-element">
                        VINCULA
                    </div>
                </li>
                   
                <?php
                     echo $menuApp;
                 ?>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="moredarkgray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>    
                    <form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group ">
                          <span class="navbar-brand" style="z-index:-9"> <?php echo $this->Html->image('sistema_in.png',array('style'=>'display:inline')); ?>  </span>
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right" style="margin-right: -2px;">
                   
                    <li>
                         <?php        
                         echo $this->Html->link('<i class="fa fa-sign-out"></i> Cerrar Sesión',
                         array('plugin'=>'','controller'=>'co_users','action'=>'logout')
                         ,array('title'=>'Salir del Sistema','escape'=>false));
                         ?>
                    </li>
                </ul>

            </nav>
        </div>
       
      <?php
      
        //Desplegamos el contenido de cada pagina
           //if ($this->Session->check('Flash.flash'))  
              
           
       echo $this->fetch('content'); 
       ?>
        <div class="footer">
            <div class="" style="text-align: center;">
                 <?php echo date('Y') ?> ICATQR.
            </div>
            <div>                                                         
                 
            </div>
        </div>

    </div>
</div>

    <div class=" row container-fluid">
            <?php echo $this->element('sql_dump'); ?>
    </div>

         <?php
         // echo $this->Html->script('inspinia/jquery-2.1.1.js');
        echo $this->Html->script('inspinia/bootstrap.min');
        echo $this->Html->script('inspinia/plugins/metisMenu/jquery.metisMenu');
         echo $this->Html->script('inspinia/plugins/slimscroll/jquery.slimscroll.min');
          echo $this->Html->script('inspinia/inspinia');
           echo $this->Html->script('inspinia/plugins/pace/pace.min');
         echo $this->Html->script('inspinia/plugins/toastr/toastr.min.js');  

                                
           //Mensajes del sistema
        echo $this->Flash->render();
          echo $this->Flash->render('auth',array('element'=>'Flash/unauthorized')); 
        
       ?>
       
    </body>   
</html>