<?php
//aqui es donde haremos las invocaciones
//vamos a requerir a poligono
require 'Poligonos.php';
//ahora las caracteristicas de un triangulo y las demas
require 'Triangulo.php';
require 'Cuadrado.php';
require 'Rectangulo.php';
require 'Hexagono.php';

echo '
	<h1>Polígonos</h1>
	<p>Figura geométrica plana que está limitada por tres o más rectas y tiene tres o más ángulos y vértices.</p>
	<h2>Perímetro</h2>
	<p>El perímetro de un polígono es igual a la suma de las longitudes de sus lados.</p>
	<h2>Área</h2>
	<p>El área de un polígono es la medida de la región o superficie encerrada por un polígono.</p>
	<hr>
';

echo '<h3>Tríangulo</h3><img src="http://bextlan.com/img/para-cursos/poo-triangulo.png">';

$triangulo = new Triangulo(3, 6, 9, 10);
echo '<p>Perímetro del ' . get_class($triangulo) . ': <mark>' . $triangulo->perimetro() . '</mark></p>';
