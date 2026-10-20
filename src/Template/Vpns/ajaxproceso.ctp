<div id="post1">

<div class="form-group required"><label for="cat-adscripcione-id" class="col-sm-3 control-label">Área Solicitante</label>
<div class="col-sm-9"><select name="cat_adscripcione_id" class="form-control" id="cat-adscripcione-id" required="required">
    <option value="">SELECCIONAR...</option>
    <?php
         foreach($adscripciones as $adscripciones2)
                echo '<option value="'.$adscripciones2['cat_adscripcione_id'].'">'.$adscripciones2['nom_ads'].'</option>';
     ?>
    </select></div></div></div>