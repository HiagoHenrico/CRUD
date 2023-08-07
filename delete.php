<?php 
require 'banco.php';

$id = 0;

if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if(!empty($_POST)) {
    $id = $_POST['id'];

    //Deletando usuário
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM pessoa WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Deletar Contato</title>
</head>
<body>

<div class="container">
    <div class="span10 offset1">
        <div class="row">
           <h3 class="well">Excluir Contato</h3>
        </div>
        <form class="form-horizontal" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="alert alert-danger">Deseja excluir o contato?</div>
            <div class="form-actions">
                <button class="btn btn-danger" type="submit">Sim</button>
                <a href="index.php" type="btn" class="btn btn-default">Não</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>