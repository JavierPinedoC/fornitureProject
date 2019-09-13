<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>Innovo-Salas</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h3>Salas</h3>
        </div>
        <div class="row">
            <p>
                <a href="index.php" class="btn">Regresar a inicio</a>
                <a href="createsala.php" class="btn btn-success">Agregar Sala</a>
                <a href="modelosala.php" class="btn btn-success">Agregar Modelo</a>
            </p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo Madera</th>
                        <th>Tipo de Tela</th>
                        <th>Color</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'database.php';
                    $pdo = Database::connect();
                    $sql = "SELECT salaid, nombresala, nombremadera, nombretela, nombrecolor, preciosala  from inventariosalas ins JOIN salanombre sn ON ins.salanombreid = sn.salanombreid JOIN madera ma ON ins.maderaid = ma.maderaid JOIN tela te ON ins.telaid = te.telaid JOIN color co ON ins.colorid = co.colorid;";
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['nombresala'] . '</td>';
                        echo '<td>' . $row['nombremadera'] . '</td>';
                        echo '<td>' . $row['nombretela'] . '</td>';
                        echo '<td>' . $row['nombrecolor'] . '</td>';
                        echo '<td>' . $row['preciosala'] . '</td>';
                        /*echo '<td>';
						echo ($row['ac']) ? "SI" : "NO";
						echo '</td>';*/
                        echo '<td width=250>';
                        echo '<a class="btn" href="readsala.php?id=' . $row['salaid'] . '">Detalles</a>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-success" href="updatesala.php?id=' . $row['salaid'] . '">Actualizar</a>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-danger" href="deletesala.php?id=' . $row['salaid'] . '">Eliminar</a>';
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