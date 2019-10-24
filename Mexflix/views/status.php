<?php 
//gestion de estatus
print('<h2 class="p1">GESTIÓN DE STATUS</h2>');


//
$status_controller = new StatusController();
//invocando el metodo get de status_controller quwe trae todo lo que tenga status
$status = $status_controller->get();

//ya optimizamo en la unidad 5 optimanzdo las queris en aregloss
if( empty($status) ) {//si esta vacio hubo unn error o esta vacio
	//invocamos el error 
	print( '
		<div class="container">
			<p class="item  error">No hay Status</p>  
		</div>
	');
} else {
	//tabla que se muestra en status; metodos post para manipular tiene dos imuts el formulario
	//
	$template_status = '
	<div class="item">
		<table>
			<tr>
				<th>Id</th>
				<th>Status</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="status-add">
						<input class="button  add" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';
			//mientrs n sea 0 y sea menor al numero que tra status aumenta 1 
			//los botones se maquetaron en el video anterior RECORDATORIO (CLASE 35);
			//NO EQUIVOCARSE PONIENDO EN ESTE CASO "n" SIN EL $ de lo contrario no mostrara la información
		for ($n=0; $n < count($status); $n++) { 
		$template_status .= '
			<tr>
				<td>' . $status[$n]['status_id'] . '</td>
				<td>' . $status[$n]['status'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="status-edit">
						<input type="hidden" name="status_id" value="' . $status[$n]['status_id'] . '">
						<input class="button  edit" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="status-delete">
						<input type="hidden" name="status_id" value="' . $status[$n]['status_id'] . '">
						<input class="button  delete" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		'; 
	}

	$template_status .= '
		</table>
	</div>
	';

	print($template_status);
}