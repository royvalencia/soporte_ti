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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo 'Incidencias y Servicios'; ?>
        </title>
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('inspinia/bootstrap.min');
            echo $this->Html->css('font-awesome.min');
            echo $this->Html->css('inspinia/plugins/toastr/toastr.min');
            echo $this->Html->css('inspinia/animate');
            echo $this->Html->css('inspinia/style-purple');
            //echo $this->Html->css('inspinia/custom'); //EStilos propios
            //echo $this->Html->script('jquery-2.1.0.min');
            echo $this->Html->script('inspinia/jquery-2.1.1.js');
            echo $this->Html->script('inspinia/plugins/toastr/toastr.min');

        ?>

    </head>
    <body class="darkgray-bg">
        <div class="loginColumns animated fadeInDown">
            <div class="row">
                <div class="col-md-6">
                    <p class="m-t" style="text-align: center">
                        <?php  echo $this->Html->image('logo_inicio.png', array('style'=>array('display:inline'),'class'=>array('img-responsive'))); ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <!--<div class="middle-box text-center loginscreen animated fadeInDown" style="padding-top: 5px">
                        <div>-->
                    <?= $this->Flash->render() ?>

                    <?php echo $this->fetch('content'); ?>
                        <!--</div>
                    </div>-->
                </div>
            </div>
        </div>
    </body>
    <?php
        echo $this->Html->script('inspinia/bootstrap.min');
     ?>
</html>
