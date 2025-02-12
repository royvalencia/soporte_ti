<?php echo $this->Html->css('jasny-bootstrap.min.css'); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');

use Cake\Routing\Router; ?>
<?php echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker.es'); ?>
<?php echo $this->Html->css('main-datepicker'); ?>
<?php echo $this->Html->script('eModal.min'); //AJAX MODAL 
?>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">

                    <br>
    <!-- ****************************************** -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-th"></i> <?= __('Detalle del Usuario'); ?> </h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-toolbar" role="toolbar">



                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="">
                        <table class="table table-striped table-detalle" style="width: 100%;">
                            <tbody>




                                <tr>
                                    <td class="field"><?= __('Nombre') ?></td>
                                    <td><?= h($coUser->nombre) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Email') ?></td>
                                    <td><?= h($coUser->email) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Teléfono') ?></td>
                                    <td><?= h($coUser->telefono) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Dependencia') ?></td>
                                    <td><?= h($coUser->dependencia->nombre) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Dirección') ?></td>
                                    <td><?= h($coUser->direccione->nombre) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Ult. inicio de sesión') ?></td>
                                    <td><?= h($coUser->last_login) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- ****************************************** -->





    </div>
            </div>
        </div>
    </div>
</div>

<!-- Jasny -->
<?php echo $this->Html->script('inspinia/plugins/jasny/jasny-bootstrap.min.js'); ?>

<script type="text/javascript">
    var dtp = $('.tipoFecha').datepicker({
            language: 'es'
        })
        .on('changeDate', function(e) {
            dtp.datepicker('hide');
        });
</script>