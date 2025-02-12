<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        Smart Warehouse <?= $this->fetch('title') ?>
    </title>  
    <?php 

 echo $this->Html->css('inspinia/bootstrap.min',['fullBase' => true]);    
        echo $this->Html->css('font-awesome.min',['fullBase' => true]);
        echo $this->Html->css('inspinia/plugins/toastr/toastr.min',['fullBase' => true]);
        echo $this->Html->css('inspinia/animate',['fullBase' => true]);
        echo $this->Html->css('inspinia/style-blue',['fullBase' => true]);
        echo $this->Html->css('inspinia/custom',['fullBase' => true]); //EStilos propios
    ?>
</head>
<body>
    <div id="container">
        <div id="content">
                     
            <?= $this->fetch('content') ?>           
        </div>
    </div>
</body>
</html>