<?php
require 'database.php';

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}


if (!empty($_POST)) {
    $f_idError = null;
    $nombrebaseError = null;

    $f_id = $_POST['f_id'];
    $nombrebase = $_POST['nombresala'];

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
        $sql = "UPDATE salanombre SET salanombreid = ?, nombresala = ? WHERE salanombreid = ?;";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($f_id, $nombrebase, $id), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: modelosala.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM salanombre WHERE salanombreid = ?;";

    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $f_id = $data['salanombreid'];
    $nombrebase = $data['nombresala'];
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
            <form action="updatenombresala.php?id=<?php echo $id ?>" class="form-horizontal" method="post">

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
                        <input name="nombresala" placeholder="Tipo Modelo" type="text" value="<?php echo !empty($nombrebase) ? $nombrebase : ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a class="btn" href="modelosala.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>