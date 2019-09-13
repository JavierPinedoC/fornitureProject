<?php
require 'database.php';

$sillonnombreError = null;
$maderaError = null;
$telaError = null;
$colorError = null;
$preciosillonError = null;


if (!empty($_POST)) {

    $sillonnombre = $_POST['sillonnombre'];
    $madera = $_POST['madera'];
    $tela = $_POST['tela'];
    $color = $_POST['color'];
    $preciosillon = $_POST['preciosillon'];

    $valid = true;

    if (empty($sillonnombre)) {
        $sillonnombreError = 'Por favor elige un modelo';
        $valid = false;
    }
    if (empty($madera)) {
        $maderaError = 'Por favor elige un tipo de madera';
        $valid = false;
    }
    if (empty($tela)) {
        $telaError = 'Por favor elige el tipo de tela';
        $valid = false;
    }
    if (empty($color)) {
        $colorError = 'Por favor elige un color';
        $valid = false;
    }
    if (empty($preciosillon)) {
        $preciosillonError = 'Por favor escribe el precio de la sillon';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO inventariosillon (sillonnombreid,maderaid,telaid,colorid,preciosillon) VALUES(?,?,?,?,?);";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($sillonnombre, $madera, $tela, $color, $preciosillon), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: innovosillones.php");
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
    <title>Agregar un Sillon</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Sillon al Inventario</h3>
            </div>
            <form action="createsillon.php" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($sillonnombreError) ? 'error' : ''; ?>">
                    <label class="control-label">Modelo</label>
                    <div class="controls">
                        <select name="sillonnombre">
                            <option value="">Selecciona un Sillon</option>
                            <?php
                            $pdo = Database::connect();
                            $query = "SELECT * FROM sillonnombre ORDER BY nombresillon;";
                            foreach ($pdo->query($query) as $row) {
                                if ($row['sillonnombreid'] == $sillonnombre)
                                    echo "<option selected value='" . $row['sillonnombreid'] . "'>" . $row['nombresillon'] . "</option>";
                                else
                                    echo "<option value='" . $row['sillonnombreid'] . "'>" . $row['nombresillon'] . "</option>";
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <?php if (($sillonnombreError != null)) ?>
                        <span class="help-inline"><?php echo $sillonnombreError; ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($maderaError) ? 'error' : ''; ?>">
                    <label class="control-label">Tipo de Madera</label>
                    <div class="controls">
                        <select name="madera">
                            <option value="">Selecciona Tipo de Madera</option>
                            <?php
                            $pdo = Database::connect();
                            $query = "SELECT * FROM madera ORDER BY nombremadera;";
                            foreach ($pdo->query($query) as $row) {
                                if ($row['maderaid'] == $madera)
                                    echo "<option selected value='" . $row['maderaid'] . "'>" . $row['nombremadera'] . "</option>";
                                else
                                    echo "<option value='" . $row['maderaid'] . "'>" . $row['nombremadera'] . "</option>";
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <?php if (($maderaError != null)) ?>
                        <span class="help-inline"><?php echo $maderaError; ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($telaError) ? 'error' : ''; ?>">
                    <label class="control-label">Tipo de Tela</label>
                    <div class="controls">
                        <select name="tela">
                            <option value="">Selecciona Tipo de tela</option>
                            <?php
                            $pdo = Database::connect();
                            $query = "SELECT * FROM tela ORDER BY nombretela;";
                            foreach ($pdo->query($query) as $row) {
                                if ($row['telaid'] == $tela)
                                    echo "<option selected value='" . $row['telaid'] . "'>" . $row['nombretela'] . "</option>";
                                else
                                    echo "<option value='" . $row['telaid'] . "'>" . $row['nombretela'] . "</option>";
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <?php if (($telaError != null)) ?>
                        <span class="help-inline"><?php echo $telaError; ?></span>
                    </div>
                </div>
                
                <div class="control-group <?php echo !empty($colorError) ? 'error' : ''; ?>">
                    <label class="control-label">Tipo de color</label>
                    <div class="controls">
                        <select name="color">
                            <option value="">Selecciona Tipo de color</option>
                            <?php
                            $pdo = Database::connect();
                            $query = "SELECT * FROM color ORDER BY nombrecolor;";
                            foreach ($pdo->query($query) as $row) {
                                if ($row['colorid'] == $color)
                                    echo "<option selected value='" . $row['colorid'] . "'>" . $row['nombrecolor'] . "</option>";
                                else
                                    echo "<option value='" . $row['colorid'] . "'>" . $row['nombrecolor'] . "</option>";
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <?php if (($colorError != null)) ?>
                        <span class="help-inline"><?php echo $colorError; ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($preciosillonError) ? 'error' : ''; ?>">
                    <label class="control-label">Precio</label>
                    <div class="controls">
                        <input name="preciosillon" placeholder="Precio (MXN)" type="text" value="<?php echo !empty($preciosillon) ? $preciosillon : ''; ?>">
                        <?php if (($preciosillonError != null)) ?>
                        <span class="help-inline"><?php echo $preciosillonError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="innovosillones.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>