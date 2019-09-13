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
    $nombremaderaError = null;

    $f_id = $_POST['f_id'];
    $nombremadera = $_POST['nombremadera'];

    $valid = true;

    if (empty($nombremadera)) {
        $maderaError = 'Por favor modifique';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE madera SET maderaid = ?, nombremadera = ? WHERE maderaid = ?;";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($f_id, $nombremadera, $id), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: materialmadera.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM madera WHERE maderaid = ?;";

    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $f_id = $data['maderaid'];
    $nombremadera = $data['nombremadera'];
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
    <title>Agregar un tipo de Madera</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Tipo de Madera</h3>
            </div>
            <form action="updatemadera.php?id=<?php echo $id ?>" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($f_idError) ? 'error' : ''; ?>">
                    <label class="control-label">ID</label>
                    <div class="controls">
                        <input name="f_id" type="text" readonly placeholder="id" value="<?php echo !empty($id) ? $id : ''; ?>">
                        <?php if (!empty($f_idError)) : ?>
                            <span class="help-inline"><?php echo $f_idError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($nombremaderaError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombremadera" placeholder="Tipo Madera" type="text" value="<?php echo !empty($nombremadera) ? $nombremadera : ''; ?>">
                        <?php if (($nombremaderaError != null)) ?>
                        <span class="help-inline"><?php echo $nombremaderaError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a class="btn" href="materialmadera.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>