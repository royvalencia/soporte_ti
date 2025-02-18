<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('eModal.min'); //AJAX MODAL ?>
<?php use Cake\Routing\Router; ?> 


<script>
   setInterval(() => {
      $.ajax({
          method: 'get',
          url: "<?php echo $this->Url->build(['controller' => 'Servicios', 'action' => 'refrescar']); ?>",
          data: {
            institucion: 1
          },
          success: function(response) {

            //alert(response);
            if (response!=0){
               alert("Hay Servicios nuevos Creados");
               //alert(response);
               location.reload();
            }

          }
        });

   }, 15000);
</script>

<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2><?= __('Servicios') ?></h2>
   </div>
   <div class="col-lg-2"> </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5><?= __('Lista de Servicios') ?></h5>
            </div>
            <div class="ibox-content">
               <div class="row">
                  <div class="col-md-12">
                     <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group pull-right">
                           <?php echo $this->Html->link('<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false, 'rel' => 'tooltip', 'title' => 'Agregar')); ?>
                        </div>
                        <div class="btn-group pull-right">

                           <?php
                           if ($tipo != 4) {
                              echo $this->Html->link('<i class="fa fa-file-excel-o"></i> Excel', array('action' => 'servicios-excel'), array('class' => 'btn btn-default', 'escape' => false, 'rel' => 'tooltip', 'title' => 'Excel'));
                           }
                           ?>
                        </div>
                     </div>
                  </div>
               </div>



               <div class="row">
                  <div class="col-md-12">
                     <?php
                     use Cake\I18n\FrozenTime;

                     $myTemplates = [
                        'formStart' => '<form{{attrs}} class="form-inline">',
                        'inputContainer' => '<div class="form-group container-inline {{type}}{{required}}">{{content}}</div>',
                        'input' => '<input type="{{type}}" name="{{name}}" class="form-control input-sm" {{attrs}}/>',
                        'select' => ' <select name="{{name}}"{{attrs}} class="form-control input-sm">{{content}}</select>',
                        'label' => '<label  {{attrs}}>{{text}}</label>',

                     ];
                     $this->Form->templates($myTemplates);
                     echo $this->Form->create(null, ['url' => ['action' => 'buscar']]);
                     echo $this->Form->input('folio', ['label' => false, 'placeholder' => 'Folio', 'required' => false]);
                     echo $this->Form->input('asunto', ['label' => false, 'placeholder' => 'Asunto', 'required' => false]);

                     if ($tipo != 4) {
                        echo $this->Form->input('descripcion', ['label' => false, 'placeholder' => 'Descripción', 'required' => false]);
                     }

                     echo $this->Form->input('statu_id', ['options' => $status, 'label' => false, 'empty' => ' - Estado -']);
                     if ($tipo != 4) {
                        echo $this->Form->input('tipo_incidencia_id', ['options' => $tipoIncidencias, 'label' => false, 'empty' => ' - Tipo -']);
                        echo $this->Form->input('grupo_id', ['options' => $grupos, 'label' => false, 'empty' => ' - Módulo -']);
                        echo $this->Form->input('co_group_id', ['label' => false, 'empty' => '- Grupo -', 'options' => $coGroups]);
                        echo $this->Form->input('agente', ['options' => $agentes, 'label' => false, 'empty' => ' - Agentes -']);
                        echo $this->Form->input('usuario', ['options' => $usuarios, 'label' => false, 'empty' => ' - Usuarios -']);
                        echo $this->Form->input('referencia', ['label' => false, 'placeholder' => 'Referencia', 'required' => false]);
                     }



                     echo $this->Form->hidden('destino', array('default' => 'index')); //Debemos indicar  a donde se redigira despeus de aplicar la busqueda
                     echo $this->Form->button(__('<i class="fa fa-search"></i> Buscar'), array('type' => 'submit', 'class' => 'btn btn-sm', 'div' => false, 'escape' => false));
                     if (!empty($argumentos))
                        echo $this->Html->link(__('<i class="fa fa-list"></i>Ver Todos'), array('action' => 'buscar', 1), array('class' => 'btn btn-primary  btn-sm', 'escape' => false, 'role' => 'button'));
                     echo $this->Form->end();
                     ?>
                  </div>
               </div>





               <br>
               <table class="table table-striped table-hover table-index">
                  <tbody>
                     <?php foreach ($servicios as $servicio): ?>
                        <tr>
                           <div class="dropdown-messages-box">
                              <td>
                                 <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="" class="rounded-circle" src="img/a7.jpg">
                                 </a>
                              </td>
                              <td>
                                  <div class="media-body">
                                      <font size=4><strong><?php echo "#" . $this->Number->format($servicio->servicio_id); ?></strong></font>
                                      <font size=4><strong><?= h(strtoupper($servicio->asunto)) ? $this->Html->link(strtoupper($servicio->asunto), ['controller' => 'Servicios', 'action' => 'view', $servicio->servicio_id]) : '' ?></strong></font> <br>
                                      <medium class="text-muted">De: <font color="blue">
                                      <?php if ($tipo != 4) { ?>
                                      <a href="#" onclick="ajaxRequestDocumentos(<?=$servicio->co_user_id?>)"><?=$servicio->co_user->nombre?></a>
                                      <?php } else {
                                       echo h($servicio->co_user->nombre);
                                      }
                                       
                                       ?>
                                      <?php //echo h($servicio->co_user->nombre) ? $this->Html->link(h($servicio->co_user->nombre), ['controller' => 'CoUsers', 'action' => 'view_centro', $servicio->co_user_id]) : ''; ?>
                                    </font> <?php if ($tipo!=4){ ?>Asignado a: <font color="green"><?= h($agentes[$servicio->agente]) ?></font> Módulo: <?= $servicio->grupo->descripcion ?> <?php }?> </medium> <br>
                                      <small class="text-muted">
                                          <?php echo date_format($servicio->created,"d-m-Y h:i A"); ?>
                                          Creado hace <?php
                                          $ahora = FrozenTime::now();
                                          $diferencia = $servicio->created->diff($ahora);
                                          //debug($diferencia);
                                          //Si son mas de 24Hrs se debes mostrar "Creado hace N Dias"
                                          //Si es menos de 24Hrs, se debe mostrar "Creado hace N Horas"
                                          //Si no llega a 59 min, se debe mostrar "Creado hace N Minutos"
                                          //$tiempo_transcurrido = $diferencia->format('%y años, %m meses, %d días, %H horas, %i minutos, %s segundos');
                                          if ($diferencia->days > 0) {
                                              $tiempo_transcurrido = "{$diferencia->days} días";
                                          } elseif ($diferencia->h > 0) {
                                              $tiempo_transcurrido = "{$diferencia->h} horas";
                                          } else {
                                              $tiempo_transcurrido = "{$diferencia->i} minutos";
                                          }
                                          echo $tiempo_transcurrido; ?>
                                       <BR>
                                          <?php echo date_format($servicio->fecha_creacion,"d-m-Y h:i A"); ?>
                                          Último Mensaje hace <?php
                                          
                                          $diferencia = $servicio->fecha_creacion->diff($ahora);
                                          
                                          if ($diferencia->days > 0) {
                                              $tiempo_transcurrido = "{$diferencia->days} días";
                                          } elseif ($diferencia->h > 0) {
                                              $tiempo_transcurrido = "{$diferencia->h} horas";
                                          } else {
                                              $tiempo_transcurrido = "{$diferencia->i} minutos";
                                          }
                                          echo $tiempo_transcurrido; ?>   
                                       </small>
                                  </div>
                              </td>
                              <?php
                              if ($servicio->prioridade->descripcion == "Baja") {
                                 $labelp = "label-primary";
                              } elseif ($servicio->prioridade->descripcion == "Media") {
                                 $labelp = "label-success";
                              } elseif ($servicio->prioridade->descripcion == "Alta") {
                                 $labelp = "label-warning";
                              } elseif ($servicio->prioridade->descripcion == "Urgente") {
                                 $labelp = "label-danger";
                              }
                              ?>
                              <td><BR><span class="label <?= $labelp ?>"><?= $servicio->prioridade->descripcion ?></span></td>
                              <td><BR><span class="<?= $servicio->status->color ?>"><?= $servicio->status->descripcion ?></span></td>
                           </div>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
               <div class="row">
                  <div class="col-md-6" style="margin-bottom: 10px;">
                     <?php
                     echo $this->Paginator->counter(array(
                        'format' => __('Mostrando del {{start}} al {{end}} de un total de {{count}}')
                     ));
                     ?>
                  </div>
                  <div class="col-md-6">
                     <div class="pagination borderless pull-right custom-pagination">
                        <?php
                        echo $this->Paginator->prev(' << ' . __('Anterior'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
                        echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
                        echo $this->Paginator->next(__('Siguiente') . ' >> ', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
                        ?>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
function ajaxRequestDocumentos(id) 
{      
   
    eModal.ajax(
    {
        method: "GET",
        size: 'md',
        url: "<?php echo Router::url(array('controller'=>'coUsers','action'=>'view_centro')) ?>"+"/"+id,
        buttons: [                
        { text: "Cerrar", close: true, style: "danger"}
            ]
    }, "Usuarios"
    );
}
function hola() 
{
   alert("prueba");
}


</script>
