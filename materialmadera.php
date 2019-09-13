<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Innovo-Material</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Madera</h3>
		</div>
		<div class="row">
			<p>
				<a href="innovomateriales.php" class="btn" >Regresar a Materiales</a>
				<a href="createmadera.php" class="btn btn-success" >Agregar Madera</a>
			</p>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tipo de Madera</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT  maderaid,nombremadera from madera;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
                        echo '<td>' . $row['nombremadera'] . '</td>';
						echo '<td width=250>';
						//echo '<a class="btn" href="readmadera.php?id=' . $row['maderaid'] . '">Detalles</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-success" href="updatemadera.php?id=' . $row['maderaid'] . '">Actualizar</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-danger" href="deletemadera.php?id=' . $row['maderaid'] . '">Eliminar</a>';
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