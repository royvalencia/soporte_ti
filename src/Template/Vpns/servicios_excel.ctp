<h2 id="page-heading"><?php __('Lista de Servicios');?></h2> 		

<table cellpadding="0" cellspacing="0">
    <?php $tableHeaders =  $this->Html->tableHeaders(array('Folio','Fecha Solicitud','Descripción','Tipo Servicio','Área Solicitante','Fecha Límite','Responsable','Fecha Solución','Status'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>

<?php
	$i = 0;
	foreach ($servicios as $servicio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $servicio->servicio_id; ?>&nbsp;</td>
		<td><?php echo $servicio->fecha_solicitud; ?>&nbsp;</td>
		<td><?php echo $servicio->descripcion_corta; ?>&nbsp;</td>
		
		<td>
			<?php echo $servicio->tipo_servicio->descripcion; ?>
		</td>

		<td>
			<?php echo $servicio->cat_adscripcione->nom_ads; ?>
		</td>
		<td><?php echo $servicio->fecha_limite_solucion; ?>&nbsp;</td>
		<td>
			<?php echo $servicio->co_user->nombre; ?>
		</td>
		<td><?php echo $servicio->fecha_solucion; ?>&nbsp;</td>
		<td>
			<?php echo $servicio->status->descripcion; ?>
		</td>
		
		
	</tr>
<?php endforeach; ?>
</table>