<?php
    

 ?>


<div id="post1">

<div class="form-group"><label for="CatInstituciones" class="col-sm-3 control-label">Instituciones</label>
<div class="col-sm-9"><select name="data[CatInstituciones][nombre]" class="form-control" id="CatInstituciones">
    <option value="">SELECCIONAR...</option>
    <?php
         foreach($CatInstituciones as $CatInstituciones2)
                echo '<option value="'.$CatInstituciones2['CatInstituciones']['id_institucion'].'">'.$CatInstituciones2['CatInstituciones']['nombre'].'</option>';
     ?>
    </select></div></div></div>