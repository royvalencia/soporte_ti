<h2 id="page-heading"><?php __('Lista de Servicios');?></h2> 		

<table cellpadding="0" cellspacing="0">


    <?php $tableHeaders =  $this->Html->tableHeaders(array('Folio','Asunto','Estado','Prioridad','Fecha Creación','Fecha Actualización','Tipo','Grupo','Dependencia','Dirección','Modulo','Usuario','Agente','Referencia'));
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
		<td><?php echo $servicio->asunto; ?>&nbsp;</td>
		<td>
			<?php echo $servicio->status->descripcion; ?>
		</td>
		<td>
			<?php echo $servicio->prioridade->descripcion; ?>
		</td>
		<td><?php echo date_format($servicio->created, 'd-m-Y'); ?>&nbsp;</td>
		<td><?php echo date_format($servicio->modified, 'd-m-Y'); ?>&nbsp;</td>
		<td>
			<?php echo $servicio->tipo_incidencia->descripcion; ?>
		</td>
		<td>
			<?php echo $servicio->co_group->name; ?>
		</td>
		<td>
			<?php echo $servicio->dependencia->nombre; ?>
		</td>
		<td>
			<?php echo $servicio->direccione->nombre; ?>
		</td>
		<td>
			<?php echo $servicio->grupo->descripcion; ?>
		</td>
		<td>
			<?php echo $servicio->co_user->nombre; ?>
		</td>
		<td>
			<?php echo $agentes[$servicio->agente]; ?>
		</td>
		<td><?php echo $servicio->referencia; ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
</table>