<?php
require 'database.php';

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}


if (!empty($_POST)) {
    $f_idError = null;
    $nombrebaseError = null;

    $f_id = $_POST['f_id'];
    $nombrebase = $_POST['nombresillon'];
    $largosillon  = $_POST['largosillon'];
    $altosillon = $_POST['altosillon'];
    $anchosillon = $_POST['anchosillon'];

    $valid = true;

    if (empty($nombrebase)) {
        $nombrebaseError = 'Por favor modifique';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE sillonnombre SET sillonnombreid = ?, nombresillon = ?, largosillon=?, anchosillon=?, altosillon=? WHERE sillonnombreid = ?;";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($f_id, $nombrebase, $largosillon, $altosillon, $anchosillon, $id), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: modelosillon.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM sillonnombre WHERE sillonnombreid = ?;";

    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);    
    $f_id = $data['sillonnombreid'];
    $nombrebase = $data['nombresillon'];
    $largosillon  = $data['largosillon'];
    $altosillon = $data['altosillon'];
    $anchosillon = $data['anchosillon'];
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
    <title>Agregar un tipo de Modelo</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Tipo de modelo</h3>
            </div>
            <form action="updatenombresillon.php?id=<?php echo $id ?>" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($f_idError) ? 'error' : ''; ?>">
                    <label class="control-label">ID</label>
                    <div class="controls">
                        <input name="f_id" type="text" readonly placeholder="id" value="<?php echo !empty($id) ? $id : ''; ?>">
                        <?php if (!empty($f_idError)) : ?>
                            <span class="help-inline"><?php echo $f_idError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombresillon" placeholder="Tipo Modelo" type="text" value="<?php echo !empty($nombrebase) ? $nombrebase : ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Alto Sillon</label>
                    <div class="controls">
                        <input name="altosillon" placeholder="Tipo Modelo" type="text" value="<?php echo !empty($altosillon) ? $altosillon : ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Ancho sillon</label>
                    <div class="controls">
                        <input name="anchosillon" placeholder="Tipo Modelo" type="text" value="<?php echo !empty($anchosillon) ? $anchosillon : ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($nombrebaseError) ? 'error' : ''; ?>">
                    <label class="control-label">Largo sillon</label>
                    <div class="controls">
                        <input name="largosillon" placeholder="Tipo Modelo" type="text" value="<?php echo !empty($largosillon) ? $largosillon : ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>
                

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a class="btn" href="modelosillon.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>