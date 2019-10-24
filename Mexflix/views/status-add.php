<?php 
//LOGICA DE VISTA
//se puede hacer con puro php o combinando
//manejamos 3 condicionales, 
//si la variable post r es igual a status add y aparte estes logueado como administrador (role),
if( $_POST['r'] == 'status-add' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {
	//un formulario y luego un formulario para ananalizar lo que tiene 
	print('
		<h2 class="p1">Agregar Status</h2>
		<form method="POST" class="item">
			<div class="p_25">
				<input type="text" name="status" placeholder="status" required>
			</div>
			<div class="p_25">
				<input  class="button  add" type="submit" value="Agregar">
				<input type="hidden" name="r" value="status-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	');	//la variable oculta crud, sirve aqui, ADEMAS SE LE PONE la ultima condicional para decir que la variable crud no este definida
} else if( $_POST['r'] == 'status-add' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set' ) {
	//Programando la insercion simepre y cuando se cumla
	//gracias a autolog podemos mandar a lllamar cualquier clase
	$status_controller = new StatusController();

	//NS es igual al arreglo
	$new_status = array(
		'status_id' => 0,
		'status' => $_POST['status']
	);

	$status = $status_controller->set($new_status);

	$template = '
		<div class="container">
			<p class="item  add">Status <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("status")
			}
		</script>
	';

	printf($template, $_POST['status']);
} else {
	//para generar una vista de no aUTORIZADO
	$controller = new ViewController();
	$controller->load_view('error401');
}