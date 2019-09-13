<?php
require 'database.php';

if (!empty($_POST)) {
    $f_idError = null;
    $nombremaderaError = null;

    $f_id = $_POST['f_id'];
    $nombremadera = $_POST['nombremadera']; 

    $valid = true;
    if (empty($nombremadera)) {
        $maderaError = 'Por favor agregue un tipo de madera';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="INSERT INTO madera (nombremadera) VALUES (?)";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($nombremadera), FILTER_SANITIZE_STRING) );
        Database::disconnect();
        header("Location: materialmadera.php");
    }
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
    <title>Agregar un tipo de Madera</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Tipo de Madera</h3>
            </div>
            <form action="createmadera.php" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($nombremaderaError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombremadera" placeholder="Tipo Madera" type="text" value="<?php echo !empty($nombremadera) ? $nombremadera : ''; ?>">
                        <?php if (($nombremaderaError != null)) ?>
                        <span class="help-inline"><?php echo $nombremaderaError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="materialmadera.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>