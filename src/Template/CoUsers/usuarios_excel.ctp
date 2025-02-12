<h2 id="page-heading"><?php __('Usuarios de la Aplicacion');?></h2> 		

<table cellpadding="0" cellspacing="0">
    <?php $tableHeaders =  $this->Html->tableHeaders(array('ID','Login','Nombre','Email','Grupo','Activo','Ult. Acceso'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>

<?php
	$i = 0;
	foreach ($usuarios as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $usuario->co_user_id; ?>&nbsp;</td>
		<td><?php echo $usuario->login; ?>&nbsp;</td>   		
		<td><?php echo $usuario->nombre; ?>&nbsp;</td>
        <td><?php echo $usuario->email; ?>&nbsp;</td> 
		<td>
			<?php echo $usuario->co_group->name; ?>
		</td>
		<td><?php echo $usuario->active; ?>&nbsp;</td>
		<td><?php echo $usuario->last_login; ?>&nbsp;</td> 	
		
	</tr>
<?php endforeach; ?>
</table>
    
          
	
