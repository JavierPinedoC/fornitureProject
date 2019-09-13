<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Sala-Modelo</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Modelo</h3>
		</div>
		<div class="row">
			<p>
				<a href="innovosalas.php" class="btn" >Regresar a Salas</a>
				<a href="createmodelosala.php" class="btn btn-success" >Agregar Sala</a>
			</p>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tipo de Sala</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT  salanombreid,nombresala from salanombre;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
                        echo '<td>' . $row['nombresala'] . '</td>';
						echo '<td width=250>';
						//echo '<a class="btn" href="readtela.php?id=' . $row['tela'] . '">Detalles</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-success" href="updatenombresala.php?id=' . $row['salanombreid'] . '">Actualizar</a>';
						echo '&nbsp;';
						echo '<a class="btn btn-danger" href="deletesalanombre.php?id=' . $row['salanombreid'] . '">Eliminar</a>';
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