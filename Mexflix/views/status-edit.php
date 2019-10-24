<?php 
//usamos el codifo de status Add
$status_controller = new StatusController();
//lo unico que ambiamos en las condicionales es status add por status eduit
if( $_POST['r'] == 'status-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {
	//status es igual a status controller y va a ser igual a get que viene en status id 
	$status = $status_controller->get($_POST['status_id']);

	if( empty($status) ) {
		//
		$template = '
			<div class="container">
				<p class="item  error">No existe el status_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("status")
				}
			</script>
		';

		printf($template, $_POST['status_id']);
	} else {
		//para el campo oculto igual se puede usar "readonly" <------ investigar
		//se creo un campo oculto , el resultado sera que el usuario no pueda modificar 
		$template_status = '
			<h2 class="p1">Editar Status</h2>
			<form method="POST" class="item">
				<div class="p_25">

					<input type="text" placeholder="status_id" value="%s" disabled required>
					<input type="hidden" name="status_id" value="%s">
				</div>
				<div class="p_25">
					<input type="text" name="status" placeholder="status" value="%s" required>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="status-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_status,
			$status[0]['status_id'],
			$status[0]['status_id'],
			$status[0]['status']
		);	
	}

} else if( $_POST['r'] == 'status-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'set' ) {	

	$save_status = array(
		//la primera dice post status id 
		'status_id' => $_POST['status_id'],
		'status' => $_POST['status']
	);

	$status = $status_controller->set($save_status);

	$template = '
		<div class="container">
			<p class="item  edit">Status <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("status")
			}
		</script>
	';

	printf($template, $_POST['status']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}