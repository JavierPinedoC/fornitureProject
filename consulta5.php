<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Consulta 5</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Consultas Interesantes</h3>
			<a href="innovoconsultas.php" class="btn">Regresar a inicio</a>
		</div>
		<div class="row">
			<h4>Consulta 5) El costo del producto mas caro por marca</h4>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Marca</th>
						<th>Costo</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT Nombre, MAX(Precios) Precio from(select nombresillon Nombre, preciosillon Precios from inventariosillon join sillonnombre on inventariosillon.sillonnombreid=sillonnombre.sillonnombreid union select nombresala, preciosala from inventariosalas join salanombre on inventariosalas.salanombreid=salanombre.salanombreid union select basenombre, preciobase from inventariobases join basenombre on inventariobases.basenombreid=basenombre.basenombreid)as tablita2 group by nombre;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>' . $row['Nombre'] . '</td>';
						echo '<td>' . $row['Precio'] . '</td>';
						echo '</tr>';
					}
					Database::disconnect();
					?>
				</tbody>
			</table>
		</div>
	</div> <!-- /container -->
	
	<footer>
		<h6 style="text-align:center">by Javier Pinedo C.</h6>
		<h6 style="text-align:center">and Everardo Becerril D.</h6>
	</footer>
</body>

</html>