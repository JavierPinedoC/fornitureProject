<?php
require 'database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id) {
    header("Location: innovosalas.php");
}

if (!empty($_POST)) {
    $f_idError = null;
    $nombrecolorError = null;

    $f_id = $_POST['f_id'];
    $nombrecolor = $_POST['nombrecolor'];

    $valid = true;

    if (empty($nombrecolor)) {
        $colorError = 'Por favor modifique';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE color SET colorid = ?, nombrecolor = ? WHERE colorid = ?;";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($f_id, $nombrecolor, $id), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: materialcolor.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM color WHERE colorid = ?;";

    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $f_id = $data['colorid'];
    $nombrecolor = $data['nombrecolor'];
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
    <title>Agregar un tipo de Color</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Tipo de Color</h3>
            </div>
            <form action="updatecolor.php?id=<?php echo $id ?>" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($f_idError) ? 'error' : ''; ?>">
                    <label class="control-label">ID</label>
                    <div class="controls">
                        <input name="f_id" type="text" readonly placeholder="id" value="<?php echo !empty($id) ? $id : ''; ?>">
                        <?php if (!empty($f_idError)) : ?>
                            <span class="help-inline"><?php echo $f_idError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($nombrecolorError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombrecolor" placeholder="Tipo Color" type="text" value="<?php echo !empty($nombrecolor) ? $nombrecolor : ''; ?>">
                        <?php if (($nombrecolorError != null)) ?>
                        <span class="help-inline"><?php echo $nombrecolorError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a class="btn" href="materialcolor.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>