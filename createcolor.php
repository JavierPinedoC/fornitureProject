<?php
require 'database.php';

if (!empty($_POST)) {
    $f_idError = null;
    $nombrecolorError = null;

    $f_id = $_POST['f_id'];
    $nombrecolor = $_POST['nombrecolor'];

    $valid = true;

    if (empty($nombrecolor)) {
        $colorError = 'Por favor agregue un tipo de color';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="INSERT INTO color (nombrecolor) VALUES (?)";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($nombrecolor), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: materialcolor.php");
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
    <title>Agregar un tipo de Color</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Tipo de Color</h3>
            </div>
            <form action="createcolor.php" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($nombrecolorError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombrecolor" placeholder="Tipo Color" type="text" value="<?php echo !empty($nombrecolor) ? $nombrecolor : ''; ?>">
                        <?php if (($nombrecolorError != null)) ?>
                        <span class="help-inline"><?php echo $nombrecolorError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="materialcolor.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>