 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo __('Ayuda');?></h2>
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5>Manuales de usuario</h5>
               </div>
            <div class="ibox-content">
                <?=
                 $this->Html->tag('iframe','',
                 [
                     'src' => $this->Url->build(['controller' => 'Ayudas','action' => 'verPDF']),
                     'width' => '100%',
                     'height' => '500px',
                     'frameborder' => '0'
                 ])
                ?>
             </div>
          </div>

        </div>
    </div>
</div>
