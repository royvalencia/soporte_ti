<h2 id="page-heading"><?php __('Lista de Servicios');?></h2> 		

<table cellpadding="0" cellspacing="0">


    <?php $tableHeaders =  $this->Html->tableHeaders(array('Folio','Asunto','Estado','Prioridad','Fecha Creación','Fecha Actualización','Tipo','Grupo','Dependencia','Dirección','Modulo','Usuario','Agente','Referencia'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>

<?php
	$i = 0;
	// Resuelve un valor del catálogo por su id; si no existe muestra '—'.
	$fmtCatalogo = function ($lista, $id) {
		return isset($lista[$id]) ? h($lista[$id]) : '—';
	};
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
			<?php echo $fmtCatalogo($statusList, $servicio->statu_id); ?>
		</td>
		<td>
			<?php echo $fmtCatalogo($prioridadesList, $servicio->prioridade_id); ?>
		</td>
		<td><?php echo date_format($servicio->created, 'd-m-Y'); ?>&nbsp;</td>
		<td><?php echo date_format($servicio->modified, 'd-m-Y'); ?>&nbsp;</td>
		<td>
			<?php echo $fmtCatalogo($tiposList, $servicio->tipo_incidencia_id); ?>
		</td>
		<td>
			<?php echo $fmtCatalogo($coGroupsList, $servicio->co_group_id); ?>
		</td>
		<td>
			<?php echo $fmtCatalogo($dependenciasList, $servicio->dependencia_id); ?>
		</td>
		<td>
			<?php echo $fmtCatalogo($direccionesList, $servicio->direccione_id); ?>
		</td>
		<td>
			<?php echo $fmtCatalogo($gruposList, $servicio->grupo_id); ?>
		</td>
		<td>
			<?php echo $fmtCatalogo($usuariosList, $servicio->co_user_id); ?>
		</td>
		<td>
			<?php echo $fmtCatalogo($agentes, $servicio->agente); ?>
		</td>
		<td><?php echo $servicio->referencia; ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
</table>