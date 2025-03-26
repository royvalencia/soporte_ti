<div id="post1">
    <div class="form-group"><label for="agente" class="col-sm-3 control-label">Agente</label>
        <div class="col-sm-9">
            <select name="agente" class="form-control" id="agente" required="required">
                <option value="">Seleccionar...</option>
                <?php
                foreach ($agente as $agente2)
                    echo '<option value="' . $agente2['co_user_id'] . '">' . $agente2['nombre'] . '</option>';
                ?>
            </select>
        </div>
    </div>

    <?php if ($coGroup == 3 OR $coGroup == 1 OR $coGroup == 5) {
        echo '<input id="grupo-id" name="grupo_id" type="hidden" value="10"/>';
    } else { ?>
        <div class="form-group"><label for="grupo" class="col-sm-3 control-label">Módulo</label>
            <div class="col-sm-9">
                <select name="grupo_id" class="form-control" id="grupo-id" required="required">
                    <option value="">Seleccionar...</option>
                    <?php
                    foreach ($grupo as $grupo2)
                        echo '<option value="' . $grupo2['grupo_id'] . '">' . $grupo2['descripcion'] . '</option>';
                    ?>
                </select>
            </div>
        </div>
    <?php } ?>
</div>
</div>