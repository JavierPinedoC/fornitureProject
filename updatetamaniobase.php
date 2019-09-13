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
    $nombrebaseError = null;

    $f_id = $_POST['f_id'];
    $nombrebase = $_POST['tamaniobase'];

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
        $sql = "UPDATE tamaniobase SET tamaniobaseid = ?, tamaniobase = ? WHERE tamaniobaseid = ?;";
        $q = $pdo->prepare($sql);
        $q->execute(array($f_id, $nombrebase, $id));
        Database::disconnect();
        header("Location: tamaniobase.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tamaniobase WHERE tamaniobaseid = ?;";

    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $f_id = $data['tamaniobaseid'];
    $nombrebase = $data['tamaniobase'];
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
    <title>Agregar un tipo de tamaño</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Tipo de tamaño</h3>
            </div>
            <form action="updatetamaniobase.php?id=<?php echo $id ?>" class="form-horizontal" method="post">

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
                        <input name="tamaniobase" placeholder="Tipo Tamaño" type="text" value="<?php echo !empty($nombrebase) ? $nombrebase : ''; ?>">
                        <?php if (($nombrebaseError != null)) ?>
                        <span class="help-inline"><?php echo $nombrebaseError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a class="btn" href="tamaniobase.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>