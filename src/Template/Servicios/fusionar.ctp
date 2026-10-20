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
          <h5><i class="fa fa-th"></i> <?= __('Fusionar'); ?> </h5>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-md-12">
              <div class="btn-toolbar" role="toolbar">
                <div class="btn-group pull-right">
                  <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default', 'rel' => 'tooltip', 'title' => 'Lista de Servicios', 'escape' => false)); ?>
                </div>

              </div>
            </div>
          </div>
          <br>
          <div class="ibox">
                            <div class="ibox-content text-center">

                                <h3 class="m-b-xxs">Los comentarios de los servicios secundarios se añadirán al servicio principal</h3>
                                <small>El servicio principal es el actual</small>

                            </div>

                        </div>
          <div class="">
            <table class="table table-striped table-detalle" style="width: 100%;">
              <tbody>
                <tr>
                  <td class="field"><?= __('#') ?></td>
                  <td><?= h($servicio->servicio_id) ?></td>
                </tr>
                <tr>
                  <td class="field"><?= __('Asunto') ?></td>
                  <td><?= h($servicio->asunto) ?></td>
                </tr>
                <tr>
                  <td class="field"><?= __('Descripcion') ?></td>
                  <td><?php echo  html_entity_decode(h($servicio->descripcion)) ?></td>
                </tr>


               

              </tbody>
            </table>

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

                <?php
                echo $this->Form->input('servicio', ['label' => 'No. de Servicio Secundario','type'=>'number']);
                ?>
                <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'div' => false, 'escape' => false)); ?>
                <?= $this->Form->end(); ?>

          </div>

        </div>
      </div>

    </div>
  </div>
</div>