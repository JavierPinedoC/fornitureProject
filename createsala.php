<?php
require 'database.php';

$salanombreError = null;
$maderaError = null;
$telaError = null;
$colorError = null;
$preciosalaError = null;


if (!empty($_POST)) {

    $salanombre = $_POST['salanombre'];
    $madera = $_POST['madera'];
    $tela = $_POST['tela'];
    $color = $_POST['color'];
    $preciosala = $_POST['preciosala'];

    $valid = true;

    if (empty($salanombre)) {
        $salanombreError = 'Por favor elige un modelo';
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
    if (empty($preciosala)) {
        $preciosalaError = 'Por favor escribe el precio de la sala';
        $valid = false;
    }

    //insert Data
    if ($valid) {
        var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO inventariosalas (salanombreid,maderaid,telaid,colorid,preciosala) VALUES(?,?,?,?,?);";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($salanombre, $madera, $tela, $color, $preciosala), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: innovosalas.php");
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
    <title>Agregar una Sala</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar una Sala al Inventario</h3>
            </div>
            <form action="createsala.php" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($salanombreError) ? 'error' : ''; ?>">
                    <label class="control-label">Modelo</label>
                    <div class="controls">
                        <select name="salanombre">
                            <option value="">Selecciona una Sala</option>
                            <?php
                            $pdo = Database::connect();
                            $query = "SELECT * FROM salanombre ORDER BY nombresala;";
                            foreach ($pdo->query($query) as $row) {
                                if ($row['salanombreid'] == $salanombre)
                                    echo "<option selected value='" . $row['salanombreid'] . "'>" . $row['nombresala'] . "</option>";
                                else
                                    echo "<option value='" . $row['salanombreid'] . "'>" . $row['nombresala'] . "</option>";
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <?php if (($salanombreError != null)) ?>
                        <span class="help-inline"><?php echo $salanombreError; ?></span>
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

                <div class="control-group <?php echo !empty($preciosalaError) ? 'error' : ''; ?>">
                    <label class="control-label">Precio</label>
                    <div class="controls">
                        <input name="preciosala" placeholder="Precio (MXN)" type="text" value="<?php echo !empty($preciosala) ? $preciosala : ''; ?>">
                        <?php if (($preciosalaError != null)) ?>
                        <span class="help-inline"><?php echo $preciosalaError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="innovosalas.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>