<?php
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($id == null) {
    header("Location: innovosalas.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM inventariosillon insi NATURAL JOIN sillonnombre siln NATURAL JOIN madera ma NATURAL JOIN tela te NATURAL JOIN color co  WHERE sillonid = ?;";
    $q = $pdo->prepare($sql);
    $q->execute(filter_var_array(array($id), FILTER_SANITIZE_STRING));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>Detalles</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Detalles del Sillon</h3>
            </div>
            <div class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">ID</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['sillonid']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Modelo</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['nombresillon']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Tipo de Madera</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['nombremadera']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Tipo de Tela</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['nombretela']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Color</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['nombrecolor']; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Largo</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['largosillon']. ' mts'; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Alto</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['altosillon']. ' mts'; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Ancho</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['anchosillon']. ' mts'; ?>
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Precio</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['preciosillon']. " MXN"; ?>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <a class="btn" href="innovosillones.php">Regresar</a>
                </div>
            </div>
        </div>
    </div><!-- /container -->
</body>

</html>