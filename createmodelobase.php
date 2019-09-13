<?php
require 'database.php';
$f_idError = null;
$nombrebaseError = null;

if (!empty($_POST)) {

    $f_id = $_POST['f_id'];
    $nombrebase = $_POST['nombrebase'];

    $valid = true;

    if (empty($nombrebase)) {
        $nombrebaseError = 'Por favor agregue un modelo de base';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="INSERT INTO basenombre (basenombre) VALUES (?)";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($nombrebase), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: modelobase.php");
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
    <title>Agregar un modelo de Base</title>
</head>


<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un modelo de Base</h3>
            </div>
            <form action="createmodelobase.php" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombrebase" placeholder="Modelo Base" type="text" value="<?php echo !empty($nombrebase) ? $nombrebase: ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="modelobase.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>