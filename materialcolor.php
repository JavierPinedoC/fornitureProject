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
			<h3>Color</h3>
		</div>
		<div class="row">
			<p>
				<a href="innovomateriales.php" class="btn" >Regresar a Materiales</a>
				<a href="createcolor.php" class="btn btn-success" >Agregar Color</a>
			</p>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tipo de Color</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT  colorid,nombrecolor from color;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
                        echo '<td>' . $row['nombrecolor'] . '</td>';
						echo '<td width=250>';
						//echo '<a class="btn" href="readcolor.php?id=' . $row['colorid'] . '">Detalles</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-success" href="updatecolor.php?id=' . $row['colorid'] . '">Actualizar</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-danger" href="deletecolor.php?id=' . $row['colorid'] . '">Eliminar</a>';
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