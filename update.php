<?php 
require 'banco.php';

$id = null;
if (null == $id) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    $nomeErr = null;
    $enderecoErr = null;
    $telefoneErr = null;
    $emailErr = null;
    $sexoErr = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];


    //VALIDACAO
    $validacao = true;
    if (empty($nome)) {
        $nomeErr = 'Por favor digite o nome!';
        $validacao = false;
    }

    if(empty($endereco)) {
        $enderecoErr = 'Por favor preencher o endereco!';
        $validacao = false;
    }

    if (empty($telefone)) {
        $telefoneErr = 'Por favor preencher o telefone!';
        $validacao = false;
    }

    if(empty($email)) {
        $emailErr = 'Por favor digite seu email!';
        $validacao = false;
    }
    
    if (empty($sexo)) {
        $sexoErr = 'Por favor preencher o campo!';
        $validacao = false;
    }

    //UPDATE DATA
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE pessoa SET nome = ?, endereco = ?, telefone = ?, email = ?, sexo = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo, $id));
        BAnco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM pessoa WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $sexo = $data['sexo'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Atualizar Contato</title>
</head>
<body>
    
<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Atualizar Contato</h3>
            </div>
            <div class="card-body">
                 <form action="update.php?id=<?php echo $id ?>" class="form-horizontal" method="post">
                    <div class="control-group <?php echo !empty($nomeErr) ? 'error' : '' ?>">
                        <label class="control-label">Nome:</label>
                        <div class="controls">
                            <input type="text" name="nome" size="50" class="form-control" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : '';?>">
                            <?php if(!empty($nomeErr)):?>
                                <span class="text-danger"><?php echo $nomeErr;?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($nomeErr) ? 'error' : '' ?>">
                        <label class="control-label">Endereço:</label>
                        <div class="controls">
                            <input type="text" name="endereco" size="50" class="form-control" placeholder="Endereco" value="<?php echo !empty($endereco) ? $endereco : '';?>">
                            <?php if(!empty($enderecoErr)):?>
                                <span class="text-danger"><?php echo $enderecoErr;?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($nomeErr) ? 'error' : '' ?>">
                        <label class="control-label">Telefone:</label>
                        <div class="controls">
                            <input type="text" name="telefone" size="50" class="form-control" placeholder="Telefone" value="<?php echo !empty($telefone) ? $telefone : '';?>">
                            <?php if(!empty($telefoneErr)):?>
                                <span class="text-danger"><?php echo $telefoneErr;?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($nomeErr) ? 'error' : '' ?>">
                        <label class="control-label">Email:</label>
                        <div class="controls">
                            <input type="text" name="email" size="50" class="form-control" placeholder="Email" value="<?php echo !empty($email) ? $email : '';?>">
                            <?php if(!empty($emailErr)):?>
                                <span class="text-danger"><?php echo $emailErr;?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($sexoErr) ? 'error' : ''; ?>">
                        <div class="controls">
                            <label class="control-label">Sexo:</label>
                                <div class="form-check">
                                    <p class="form-check-label">
                                        <input type="radio" class="form check input" name="sexo" id="sexo" value="M" <?php echo ($sexo == "M") ? "checked" : null; ?>> Masculino
                                </div>
                                <div class="form-check">
                                    <p class="form-check-label">
                                        <input type="radio" class="form check input" name="sexo" id="sexo" value="F" <?php echo ($sexo == "F") ? "checked" : null; ?>> Feminino
                                </div>
                                <?php if (!empty($sexoErr)): ?>
                                    <span class="help-inline text-danger"><?php echo $sexoErr ; ?></span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>

                 </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    
</body>
</html>