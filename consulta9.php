<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Consulta 9</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Consultas Interesantes</h3>
			<a href="innovoconsultas.php" class="btn">Regresar a inicio</a>
		</div>
		<div class="row">
			<h4>Consulta 9) De todos los productos cuantos son de color azules</h4>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Número de Productos Azules</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT count(*) NoProductosAzules from(select nombrecolor from (SELECT nombrecolor, preciosala from inventariosalas join color on inventariosalas.colorid=color.colorid union select nombrecolor, preciosillon from inventariosillon join color on inventariosillon.colorid=color.colorid union select nombrecolor, preciobase from inventariobases join color on inventariobases.colorid=color.colorid) as tablita5 where nombrecolor='azul') as tablita6;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>' . $row['NoProductosAzules'] . '</td>';
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