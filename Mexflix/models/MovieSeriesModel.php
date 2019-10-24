<?php 
class MovieSeriesModel extends Model {
	//cambiamos movieseriedata por ms
	public function set( $ms_data = array() ) {
		foreach ($ms_data as $key => $value) {
			$$key = $value;
		}

		$plot = str_replace("'", "\'", $plot);
		//cadenoas de texto con comillad 
		$this->query = "REPLACE INTO movieseries SET imdb_id = '$imdb_id', title = '$title', plot = '$plot', author = '$author', actors = '$actors', country = '$country', premiere = '$premiere', trailer = '$trailer', poster = '$poster', rating = $rating, genres = '$genres', status  = $status, category = '$category'";
		$this->set_query();
	}

	//
	public function get( $ms = '' ) {
		$this->query = ($ms != '')
		//reemplazamos del archivo de la base de datos sccrud pero a una le agregamos ms por que recibe el metodo get
			?"SELECT ms.imdb_id, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, ms.rating, ms.genres, ms.category, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id WHERE ms.imdb_id = '$ms'"
			:"SELECT ms.imdb_id, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, ms.rating, ms.genres, ms.category, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id";
		
		$this->get_query();

		$num_rows = count($this->rows);

		$data = array();

		foreach ($this->rows as $key => $value) {
			array_push($data, $value);
		}

		return $data;
	}

	public function del( $ms = '' ) {
		$this->query = "DELETE FROM movieseries WHERE imdb_id = '$ms'";
		$this->set_query();
	}

	public function __destruct() {
		unset($this->model);
	}
}