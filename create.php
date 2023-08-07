<?php

  require 'banco.php';

  if($_SERVER['REQUEST_METHOD'] == "POST") {

    $nomeErr = null;
    $enderecoErr = null;
    $telefoneErr = null;
    $emailErr = null;
    $sexoErr = null;

    if(!empty($_POST)) {

      $validacao = true;
      $novoUsuario = true;

      if(!empty($_POST['nome'])) {
        $nome = $_POST['nome'];
      } else {
        $nomeErr = "Digite seu nome!";
        $validacao = false;
      }

      if(!empty($_POST['endereco'])) {
        $endereco = $_POST['endereco'];
      } else {
        $enderecoErr = "Digite seu endereco!";
        $validacao = false;

      }

      if(!empty($_POST['telefone'])) {
        $telefone = $_POST['telefone'];
      } else {
        $telefoneErr = "Digite seu telefone!";
        $validacao = false;

      }

      if(!empty($_POST['email'])) {
        $email = $_POST['email'];
      } else {
        $emailErr = "Digite seu email!";
        $validacao = false;

      }

      if(!empty($_POST['sexo'])) {
        $sexo = $_POST['sexo'];
      } else {
        $sexoErr = "Digite seu sexo!";
        $validacao = false;

      }

    }

    if($validacao) {
      $pdo = Banco::conectar();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO pessoa (nome, endereco, telefone, email, sexo) VALUES (?, ?, ?, ?, ?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($nome, $endereco, $telefone, $email, $sexo));
      Banco::desconectar();
      header("Location: index.php");
    }
    
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Contato</title>
</head>
<body>

<div class="container">
  <div class="span10 offset1">
    <div class="card">
        <div class="card-header">
            <h3 class="well">Adicionar Contato</h3>
        </div>
        <div class="card-body">
            
                <form class="form-horizontal" action="create.php" method="post">
                  <div class="control-group <?php echo !empty($nomeErr) ? 'error' : ''; ?>">
                      <label class="control-label">Nome:</label>
                      <div class="controls">
                          <input type="text" size="50" class="form-control"  name="nome" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                          <?php if(!empty($nomeErr)): ?>
                          <span class="text-danger"><?php echo $nomeErr; ?></span>
                          <?php endif; ?>
                      </div>
                  </div>
                  <div class="control-group <?php echo !empty($enderecoErr) ? 'error' : ''; ?>">
                      <label class="control-label">Endereço:</label>
                      <div class="controls">
                          <input type="text" size="50" class="form-control"  name="endereco" placeholder="Endereço" value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                          <?php if(!empty($enderecoErr)): ?>
                          <span class="text-danger"><?php echo $enderecoErr; ?></span>
                          <?php endif; ?>
                      </div>
                  </div>
                  <div class="control-group <?php echo !empty($enderecoErr) ? 'error' : ''; ?>">
                      <label class="control-label">Telefone:</label>
                      <div class="controls">
                          <input type="text" size="50" class="form-control"  name="telefone" placeholder="Telefone" value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                          <?php if(!empty($telefoneErr)): ?>
                          <span class="text-danger"><?php echo $telefoneErr; ?></span>
                          <?php endif; ?>
                      </div>
                  </div>
                  <div class="control-group <?php echo !empty($emailErr) ? 'error' : ''; ?>">
                      <label class="control-label">Email:</label>
                      <div class="controls">
                          <input type="text" size="50" class="form-control"  name="email" placeholder="Email" value="<?php echo !empty($email) ? $email : ''; ?>">
                          <?php if(!empty($emailErr)): ?>
                          <span class="text-danger"><?php echo $emailErr; ?></span>
                          <?php endif; ?>
                      </div>
                  </div>
                  <div class="control-group <?php echo !empty($sexoErr) ? 'echo($sexoErr)' : ''; ?>">
                    <div class="controls">
                      <label class="control-label">Sexo:</label>
                        <div class="form-check">
                            <p class="form-check-label">
                              <input type="radio" class="form check input" name="sexo" id="sexo" value="M" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "M" ? "checked" : null; ?>>
                            Masculino</p>
                        </div>
                        <div class="form-check">
                            <p class="form-check-label">
                              <input type="radio" class="form check input" name="sexo" id="sexo" value="F" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "F" ? "checked" : null; ?>>
                            Feminino</p>
                        </div>
                        <?php if (!empty($sexoErr)): ?>
                          <span class="help-inline text-danger"><?php echo $sexoErr ; ?></span>
                        <?php endif; ?>
                    </div>
                  </div>
                  <div class="form-actions">
                    <button type="submit" class="btn btn-success" value="Criar">Adicionar</button>
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