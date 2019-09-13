<?php
require 'database.php';
$f_idError = null;
$nombrebaseError = null;

if (!empty($_POST)) {

    $f_id = $_POST['f_id'];
    $nombrebase = $_POST['nombresillon'];
    $altosillon = $_POST['altosillon'];
    $anchosillon = $_POST['anchosillon'];
    $largosillon = $_POST['largosillon'];

    $valid = true;

    if (empty($nombrebase)) {
        $nombrebaseError = 'Por favor agregue un modelo de sillon';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="INSERT INTO sillonnombre (nombresillon,altosillon,anchosillon,largosillon) VALUES (?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($nombrebase,$altosillon,$anchosillon,$largosillon), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: modelosillon.php");
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
    <title>Agregar un modelo de Sillon</title>
</head>


<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un modelo de Sillon</h3>
            </div>
            <form action="createmodelosillon.php" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombresillon" placeholder="Modelo SIllon" type="text" value="<?php echo !empty($nombrebase) ? $nombrebase: ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Alto Sillon</label>
                    <div class="controls">
                        <input name="altosillon" placeholder="Modelo SIllon" type="text" value="<?php echo !empty($altosillon) ? $altosillon: ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Ancho sillon</label>
                    <div class="controls">
                        <input name="anchosillon" placeholder="Modelo SIllon" type="text" value="<?php echo !empty($anchosillon) ? $anchosillon: ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Largo Sillon</label>
                    <div class="controls">
                        <input name="largosillon" placeholder="Modelo SIllon" type="text" value="<?php echo !empty($largosillon) ? $largosillon: ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="modelosillon.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>