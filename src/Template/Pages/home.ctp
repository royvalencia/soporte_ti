<?php



            $imgPerfilLayout =  $this->request->webroot .'img/user.png' ;
           if( !empty($user->image)){                                       
               $imgPerfilLayout= $this->request->webroot."upload/avatar/".$user->image."";
           }


?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Registro de Incidencias y Servicios</h2>
                   
                </div>
            </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-md-offset-4 col-lg-4">
                        <div class="widget-head-color-box navy-bg p-lg text-center">
                            <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                               <?= $user->nombre ?>
                            </h2>
                                <small><?= $user->co_group->name?></small>
                            </div>
                            <img src="<?= $imgPerfilLayout ?>" class="img-circle circle-border m-b-md"  style="width: 140px;height: 140px" alt="profile">
                            
                        </div>
                        <div class="widget-text-box">
                            <h4 class="media-heading"><?= $user->login ?></h4>
                          
                            <div class="text-right">
                               
                                <?php 
                                    echo $this->Html->link('<i class="fa fa-edit"></i> Editar Perfil',
                                     array('controller'=>'co_users','action'=>'changePassword')
                                     ,array('title'=>'Perfil del Usuario','escape'=>false,'class'=>'btn btn-xs btn-white'));
                               
                                ?>
                               
                            </div>
                        </div>
                </div>
        </div>

      
        <hr/>


</div>
