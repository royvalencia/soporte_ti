<?php
//Para acceso sin autorización mostramos este flash
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if(!isset($key)){
    $key='';
}
?>
<script type="text/javascript">
 $(document).ready(function() {
           
                toastr.options = {
                    closeButton: true,
                     positionClass: "toast-top-center",
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 6000   ,
                    extendedTimeOut: ""
                };
                toastr.warning('<?php echo $message; ?>','autorizado');

           
 });     
</script>

