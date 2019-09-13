<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>Innovo-Sillones</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h3>Sillones Individuales</h3>
        </div>
        <div class="row">
            <p>
                <a href="index.php" class="btn">Regresar a inicio</a>
                <a href="createsillon.php" class="btn btn-success">Agregar Sillon</a>
                <a href="modelosillon.php" class="btn btn-success">Agregar Modelo</a>
            </p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo Madera</th>
                        <th>Tipo de Tela</th>
                        <th>Color</th>
                        <th>Largo (mts)</th>
                        <th>Alto (mts)</th>
                        <th>Ancho (mts)</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'database.php';
                    $pdo = Database::connect();
                    $sql = "SELECT sillonid, nombresillon, nombremadera, nombretela, nombrecolor, largosillon, altosillon, anchosillon, preciosillon from inventariosillon insi JOIN sillonnombre sin ON insi.sillonnombreid = sin.sillonnombreid JOIN madera ma ON insi.maderaid = ma.maderaid JOIN tela te ON insi.telaid = te.telaid JOIN color co ON insi.colorid = co.colorid;";
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['nombresillon'] . '</td>';
                        echo '<td>' . $row['nombremadera'] . '</td>';
                        echo '<td>' . $row['nombretela'] . '</td>';
                        echo '<td>' . $row['nombrecolor'] . '</td>';
                        echo '<td>' . $row['largosillon'].'</td>';
                        echo '<td>' . $row['altosillon'].'</td>';
                        echo '<td>' . $row['anchosillon'].'</td>';
                        echo '<td>' . $row['preciosillon'] . '</td>';
                        /*echo '<td>';
						echo ($row['ac']) ? "SI" : "NO";
						echo '</td>';*/
                        echo '<td width=250>';
                        echo '<a class="btn" href="readsillon.php?id=' . $row['sillonid'] . '">Detalles</a>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-success" href="updatesillon.php?id=' . $row['sillonid'] . '">Actualizar</a>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-danger" href="deletesillon.php?id=' . $row['sillonid'] . '">Eliminar</a>';
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