<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<title>Consulta 8</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Consultas Interesantes</h3>
			<a href="innovoconsultas.php" class="btn">Regresar a inicio</a>
		</div>
		<div class="row">
			<h4>Consulta 8) Salas que tiene tela que se llame Gamuza</h4>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Número de salas con la tela Gamuza</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = "SELECT count(*) Gamuza from (select nombretela from inventariosalas join tela on inventariosalas.telaid=tela.telaid where nombretela='gamuza') as tablita4;";
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>' . $row['Gamuza'] . '</td>';
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