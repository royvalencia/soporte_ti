<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if(!isset($key)){
    $key='';
}
?>

<div class="alert alert-success">
                              <?php
                                   echo $message;
                               ?>
</div>
