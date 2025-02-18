<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
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
          <?= $this->Form->create($servicio) ?>
          <fieldset>

            <?php
            
            ?>
            
            <?php
            echo $this->Form->input('co_user_id', ['options' => $usuarios, 'label' => ['text' => 'Usuario'], 'empty' => ' - Usuario -','title' => 'Seleccione un usuario si desea crear un servicio a su nombre']);
            
            ?>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'div' => false, 'escape' => false)); ?>
                <?php echo $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('action' => 'index'), array('class' => 'btn  btn-default', 'escape' => false, 'role' => 'button')); ?>
              </div>
            </div>
          </fieldset>
          <?= $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SUMMERNOTE -->
<script>
  $(document).ready(function() {

    $('.summernote').summernote();

  });
</script>

