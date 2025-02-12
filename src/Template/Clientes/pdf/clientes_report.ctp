  <h2>Cartera de Clientes</h2>
           <table class="table table-striped table-hover table-index">
              <?php $tableHeaders =  $this->Html->tableHeaders(array('#','A. Paterno','A. Materno','Nombre','Razón Social','RFC','CURP','Genero','Estado Civil','Fecha Nacimiento','Ocupación','Lugar Nacimiento','Nacionalidad','Grupo','Observaciones'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>
             <tbody>
          <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $this->Number->format($cliente->id) ?></td>
                <td><?= h($cliente->apellido_paterno) ?></td>
                <td><?= h($cliente->apellido_materno) ?></td>
                <td><?= h($cliente->nombre) ?></td>
                <td><?= h($cliente->razon_social) ?></td>
                <td><?= h($cliente->rfc . $cliente->homoclave) ?></td>            
                <td><?= h($cliente->curp) ?></td>
                <td><?= h($cliente->genero) ?></td>
                <td><?= h($cliente->estado_civil) ?></td>
                <td><?= h($cliente->fecha_nacimiento) ?></td>
                <td><?= $cliente->has('ocupacione') ? $cliente->ocupacione->descripcion : '' ?></td>
                <td><?= h($cliente->lugar_nacimento) ?></td>
                <td><?= h($cliente->nacionalidad) ?></td>
                <td><?= h($cliente->grupo) ?></td>
                <td><?= h($cliente->observaciones) ?></td>
            </tr>
            <?php endforeach; ?>
              </tbody>  
            </table>
   