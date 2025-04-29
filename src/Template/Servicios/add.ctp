<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<script>
  $('document').ready(function() {
    var tipo = $("#tipo").val();
    $('#co-group-id').change(function() {
      var searchkey = $(this).val();
      searchTags(searchkey);
    });

    function searchTags(institucion) {
      var data = institucion;

      if (tipo == 4) {
        $.ajax({
          method: 'get',
          url: "<?php echo $this->Url->build(['controller' => 'Servicios', 'action' => 'ajaxproceso3']); ?>",
          data: {
            institucion: data
          },
          success: function(response) {
            $('#post1').html(response);
          }
        });
      } else {
        $.ajax({
          method: 'get',
          url: "<?php echo $this->Url->build(['controller' => 'Servicios', 'action' => 'ajaxproceso']); ?>",
          data: {
            institucion: data
          },
          success: function(response) {
            $('#post1').html(response);
          }
        });
      }

    };
  });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?= __('Servicios'); ?></h2>
  </div>
  <div class="col-lg-2"> </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5><i class="fa fa-edit"></i> <?= __('Agregar Servicio') ?></h5>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-md-12">
              <div class="btn-toolbar" role="toolbar">
                <div class="btn-group pull-right">
                  <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default', 'rel' => 'tooltip', 'title' => 'Lista de Servicios ', 'escape' => false)); ?>
                </div>

              </div>
            </div>
          </div>
          <br>
          <?php
          use Cake\I18n\FrozenTime;
          $myTemplates = [
            'formStart' => '<form{{attrs}} class="form-horizontal">',
            'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
            'input' => '<div class="col-sm-9"><input type="{{type}}" name="{{name}}" class="form-control" {{attrs}}/></div>',
            'label' => '<label  class="col-sm-3 control-label" {{attrs}}>{{text}}</label>',
            'select' => '<div class="col-sm-9"><select name="{{name}}"{{attrs}} class="form-control">{{content}}</select></div>',
            'selectMultiple' => '<div class="col-sm-9"><select name="{{name}}[]" multiple="multiple"{{attrs}} class="form-control">{{content}}</select></div>',
            'textarea' => '<div class="col-sm-9"><textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea></div>',
            'checkbox' => '<div class="col-sm-9 checkbox-div"><input type="checkbox" name="{{name}}"  value="{{value}}"{{attrs}}  ></div>',
            'nestingLabel' => '<label class="col-sm-3 control-label checkbox-label" {{attrs}}>{{text}}</label>{{hidden}}{{input}}'
          ];
          $this->Form->templates($myTemplates);
          ?>
          <?= $this->Form->create($servicio, ['type' => 'file']) ?>
          <fieldset>

            <?php
            if ($tipo != 4) {
            echo $this->Form->input('usuarios', ['options' => $usuarios, 'label' => ['text' => 'Usuario'], 'empty' => ' - Usuario -','title' => 'Seleccione un usuario si desea crear un servicio a su nombre']);
            }
            echo $this->Form->input('asunto',['title' => 'Aquí va el título de tu solicitud de servicio']);
            ?>
            <div class="form-group textarea required"><label class="col-sm-3 control-label" for="descripcion">Descripcion</label>
              <div class="col-sm-9"><textarea name="descripcion" required="required" id="descripcion" class="summernote" title="hola"></textarea></div>
            </div>
            <div><label class="col-sm-3 control-label" for="archivos"></label>
              <div class="col-sm-9">
                <div id="archivos">
                  <!-- Primer campo de archivo se agregará automáticamente con el evento -->
                </div>
                <br>
              </div>
            </div>

            <?php
            if ($tipo != 4) {
              echo $this->Form->input('tipo_incidencia_id', ['options' => $tipoIncidencias]);

              //echo $this->Form->input('dependencia_id', ['options' => $dependencias]);
            //echo $this->Form->input('direccione_id', ['label' => 'Dirección', 'options' => $direcciones]);

            }




            if ($tipo == 4) {




              echo $this->Form->input('co_group_id', ['label' => 'Clasificación del Servicio', 'empty' => 'Seleccionar...', 'options' => $coGroups,'title'=>'Ej. Sistemas de información (Opergob, Pagina Web Sefiplan, Portal de Servidor Público, etc) - Ej. Soporte Técnico (Problemas de internet, mantenimiento de equipos, equipos no funcionan)','required'=>'required']); ?>
              <div id="post1">
                <?php
                //echo $this->Form->input('grupo_id', array('label' => array('text' => 'Módulo'), 'options' => array('text' => 'Seleccionar...')));
                ?>
              </div>
            <?php
              echo $this->Form->hidden('statu_id', ['value' => 1]);
              echo $this->Form->hidden('prioridade_id', ['value' => 1]);
              echo $this->Form->hidden('tipo_incidencia_id', ['value' => 1]);
              echo $this->Form->hidden('usuarios', ['value' => '']);


            } else {
              echo $this->Form->input('statu_id', ['label' => 'Estado', 'options' => $status]);
              echo $this->Form->input('prioridade_id', ['label' => 'Prioridad', 'options' => $prioridades]);
              echo $this->Form->input('co_group_id', ['label' => 'Grupo', 'empty' => 'Seleccionar...', 'options' => $coGroups, 'required'=>'required']); ?>
              <div id="post1">
                <?php
                //echo $this->Form->input('agente', ['options' => $agentes]);
                echo $this->Form->input('agente', array('label' => array('text' => 'Agente'), 'options' => array('text' => 'Seleccionar...')));

                //echo $this->Form->input('grupo_id', array('label' => array('text' => 'Módulo'), 'options' => array('text' => 'Seleccionar...')));
                ?>
              </div>
            <?php
            }

            echo $this->Form->hidden('fuente', ['value' => 1]);
            //echo $this->Form->hidden('fecha_creacion', ['value' => date("Y-m-d H:i:s")]);
            $ahora = FrozenTime::now();
            $fechab= date_format($ahora,"Y-m-d H:i:s");
            echo $this->Form->hidden('fecha_creacion', ['value' => $fechab]);
            echo $this->Form->hidden('co_user_id', ['value' => $user]);
            echo $this->Form->hidden('solicitante_id', ['value' => 1]);
            echo $this->Form->hidden('dependencia_id', ['value' => $dependencia]);
            echo $this->Form->hidden('direccione_id', ['value' => $direccion]);
            //echo $this->Form->hidden('agente', ['options' => $agentes]);
            ?>
            <input id="tipo" name="tipo" type="hidden" value="<?= $tipo ?>" />

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'div' => false, 'escape' => false)); ?>
                <?php echo $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('action' => 'index'), array('class' => 'btn  btn-default', 'escape' => false, 'role' => 'button')); ?>
              </div>
            </div>
          </fieldset>
          <?= $this->Form->end(); ?>

          <!--<form id="form-subir-archivos" method="post" enctype="multipart/form-data">
            <div id="archivos">

            </div>
            <br>
            <input type="submit" value="Subir Archivos">
          </form>-->

        </div>
      </div>
    </div>
  </div>
</div>

<!-- SUMMERNOTE -->
<script>
  $(document).ready(function() {

    $('.summernote').summernote({
        height: 235,
        placeholder: 'Describe tu Solicitud lo más detallado posible.',
        toolbar: [
            ['style', ['bold','italic','underline','clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['para', ['ul','ol','paragraph']],
            ['height', ['height']]
        ]
    });

  });
</script>
<script>
  // Función para crear un nuevo campo de archivo automáticamente
  function agregarCampo() {
    var contenedorArchivos = document.getElementById("archivos");
    var input = document.createElement("input");
    input.type = "file";
    input.title = "seleccione un archivo para complementar su solicitud";
    input.name = "archivos[]"; // Enviar los archivos como un arreglo
    input.accept = 'application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*';
    input.addEventListener('change', agregarCampo); // Agregar el evento para agregar más campos
    contenedorArchivos.appendChild(input);
    contenedorArchivos.appendChild(document.createElement("br")); // Añadir salto de línea
  }

  // Función inicial que agrega el primer campo y asigna el evento de cambio
  window.onload = function() {
    agregarCampo();
  };
</script>
