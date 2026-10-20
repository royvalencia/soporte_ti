<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if(!isset($key)){
    $key='';
}
?>
<div class="alert alert-danger">
                              <?php
                                   echo $message;
                               ?>
</div>
