<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Innovo-Bases</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Bases</h3>
		</div>
		<div class="row">
			<p>
				<a href="index.php" class="btn">Regresar a inicio</a>
				<a href="createbase.php" class="btn btn-success">Agregar Base</a>
				<a href="modelobase.php" class="btn btn-success">Agregar Modelo</a>
				<a href="tamaniobase.php" class="btn btn-success">Agregar Tamaño de base</a>

			</p>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Tipo Madera</th>
						<th>Tipo de Tela</th>
						<th>Color</th>
						<th>Tamaño</th>
						<th>Precio</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT baseid, basenombre, nombremadera, nombretela, nombrecolor, tamaniobase, preciobase  from inventariobases inb JOIN basenombre bn ON inb.basenombreid = bn.basenombreid JOIN madera ma ON inb.maderaid = ma.maderaid JOIN tela te ON inb.telaid = te.telaid JOIN color co ON inb.colorid = co.colorid JOIN tamaniobase tamb ON inb.tamaniobaseid = tamb.tamaniobaseid;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>' . $row['basenombre'] . '</td>';
						echo '<td>' . $row['nombremadera'] . '</td>';
						echo '<td>' . $row['nombretela'] . '</td>';
						echo '<td>' . $row['nombrecolor'] . '</td>';
						echo '<td>' . $row['tamaniobase'] . '</td>';
						echo '<td>' . $row['preciobase'] . '</td>';
						/*echo '<td>';
						echo ($row['ac']) ? "SI" : "NO";
						echo '</td>';*/
						echo '<td width=250>';
						echo '<a class="btn" href="readbase.php?id=' . $row['baseid'] . '">Detalles</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-success" href="updatebase.php?id=' . $row['baseid'] . '">Actualizar</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-danger" href="deletebase.php?id=' . $row['baseid'] . '">Eliminar</a>';
						echo '</td>';
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