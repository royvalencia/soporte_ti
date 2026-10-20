<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo 'Incidencias y Servicios | Recuperar Contraseña'; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('inspinia/bootstrap.min');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('inspinia/plugins/toastr/toastr.min');
        echo $this->Html->css('inspinia/animate');
        echo $this->Html->css('inspinia/style-purple');
        echo $this->Html->script('inspinia/jquery-2.1.1.js');
        echo $this->Html->script('inspinia/plugins/toastr/toastr.min');

    ?>

</head>
<body class="gray-bg">
<?php echo $this->Flash->render(); ?>
<?= $this->fetch('content') ?>
</body>
<?php
echo $this->Html->script('inspinia/bootstrap.min');
?>
</html>
