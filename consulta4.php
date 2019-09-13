<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Consulta 4</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Consultas Interesantes</h3>
			<a href="innovoconsultas.php" class="btn">Regresar a inicio</a>
		</div>
		<div class="row">
			<h4>Consulta 4) Suma el precio de todos los productos en el inventario</h4>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>TOTAL PRECIO EN INVENTARIO (MXN)</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT sum(SumaPrecios) as pre from (select sum(preciosillon) SumaPrecios from inventariosillon union select sum( preciosala) from inventariosalas union select sum(preciobase) from inventariobases)as tablita1;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>' . $row['pre'] . '</td>';
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