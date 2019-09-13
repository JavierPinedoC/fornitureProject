<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Base-Modelo</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Modelo</h3>
		</div>
		<div class="row">
			<p>
				<a href="innovobases.php" class="btn" >Regresar a Bases</a>
				<a href="createmodelobase.php" class="btn btn-success" >Agregar Modelo</a>
			</p>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tipo de Modelo</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT  basenombreid,basenombre from basenombre;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
                        echo '<td>' . $row['basenombre'] . '</td>';
						echo '<td width=250>';
						//echo '<a class="btn" href="readtela.php?id=' . $row['tela'] . '">Detalles</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-success" href="updatebasenombre.php?id=' . $row['basenombreid'] . '">Actualizar</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-danger" href="deletebasenombre.php?id=' . $row['basenombreid'] . '">Eliminar</a>';
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