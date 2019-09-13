<?php
require 'database.php';
$id = 0;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
    echo $id;
}

if (!empty($_POST)) {
   $id = $_POST['id'];
    //delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM inventariosalas WHERE salaid = ?";
    $q = $pdo->prepare($sql);
    $q->execute(filter_var_array(array($id), FILTER_SANITIZE_STRING));
    Database::disconnect();
    header("Location: innovosalas.php");
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
    <title>Eliminar Sala</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Eliminar Sala</h3>
            </div>

            <form action="deletesala.php" class="form-horizontal" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <p class="alert alert-error">Estas seguro que quieres eliminar la Sala</p>
                <div class="form-action">
                    <button type="submit" class="btn btn-danger">Si</button>
                    <a href="innovosalas.php" class="btn">No</a>
                </div>
            </form>
        </div>
    </div> <!-- /container -->
</body>

</html>