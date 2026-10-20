<?php
$class = 'alert-success';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if(!isset($key)){
    $key='';
}
?>

<div class="alert <?php echo $class; ?>">
                              <?php
                                   echo $message;
                               ?>
</div>
