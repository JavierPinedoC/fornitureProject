<?php
require 'database.php';

if (!empty($_POST)) {
    $f_idError = null;
    $nombretelaError = null;

    $f_id = $_POST['f_id'];
    $nombretela = $_POST['nombretela'];

    $valid = true;

    if (empty($nombretela)) {
        $telaError = 'Por favor agregue un tipo de tela';
        $valid = false;
    }
    
    //insert Data
    if ($valid) {
        //var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="INSERT INTO tela (nombretela) VALUES (?)";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($nombretela), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: materialtela.php");
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
    <title>Agregar un tipo de Tela</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un Tipo de Tela</h3>
            </div>
            <form action="createtela.php" class="form-horizontal" method="post">

                <div class="control-group <?php echo !empty($nombretelaError) ? 'error' : ''; ?>">
                    <label class="control-label">Nombre</label>
                    <div class="controls">
                        <input name="nombretela" placeholder="Tipo Tela" type="text" value="<?php echo !empty($nombretela) ? $nombretela : ''; ?>">
                        <?php if (($nombretelaError != null)) ?>
                        <span class="help-inline"><?php echo $nombretelaError; ?></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="materialtela.php">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>