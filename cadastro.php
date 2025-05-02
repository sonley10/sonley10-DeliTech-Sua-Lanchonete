<?php

include 'verifica_cpf.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "delitech";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$emailErro = "";
$telefoneErro = "";
$cpfErro = "";
$sucesso = false;

$nome = "";
$email = "";
$telefone = "";
$endereco = "";
$cpf = "";
$dataNascimento = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['data_nascimento'];

    $emailValido = true;
    $telefoneValido = true;
    $cpfValido = true;

    $stmtEmail = $conn->prepare("SELECT id FROM clientes WHERE email = ?");
    $stmtEmail->bind_param("s", $email);
    $stmtEmail->execute();
    $stmtEmail->store_result();
    if ($stmtEmail->num_rows > 0) {
        $emailErro = "Este e-mail já foi cadastrado.";
        $emailValido = false;
    }

    $stmtTel = $conn->prepare("SELECT id FROM clientes WHERE telefone = ?");
    $stmtTel->bind_param("s", $telefone);
    $stmtTel->execute();
    $stmtTel->store_result();
    if ($stmtTel->num_rows > 0) {
        $telefoneErro = "Este telefone já foi cadastrado.";
        $telefoneValido = false;
    }

    $stmtCPF = $conn->prepare("SELECT id FROM clientes WHERE cpf = ?");
    $stmtCPF->bind_param("s", $cpf);
    $stmtCPF->execute();
    $stmtCPF->store_result();
    if ($stmtCPF->num_rows > 0) {
        $cpfErro = "Este CPF já foi cadastrado.";
        $cpfValido = false;
    }

    if ($emailValido && $telefoneValido && $cpfValido) {
        $stmt = $conn->prepare("INSERT INTO clientes (nome, email, telefone, endereco, cpf, data_nascimento) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nome, $email, $telefone, $endereco, $cpf, $dataNascimento);
        if ($stmt->execute()) {
            $sucesso = true;
            $nome = $email = $telefone = $endereco = $cpf = $dataNascimento = "";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }
        $stmt->close();
    }

    $stmtEmail->close();
    $stmtTel->close();
    $stmtCPF->close();

    if ($sucesso) {
        echo "<script>localStorage.setItem('cadastroSucesso', 'true');</script>";
        echo "<script>window.location.href = 'cadastro.php';</script>";
        exit;
    }
}


$conn->close();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Clientes</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/cadastro.css">
  <style>.erro { color: red; font-size: 0.9em; margin-top: 4px; } .sucesso { color: green; font-size: 1em; }</style>
</head>
<body>

<main>
  <section>
    <div>
      <h2>Cadastro</h2>
      <?php if ($sucesso): ?><p class="sucesso">Cadastro realizado com sucesso!</p><?php endif; ?>
      <form id="formCadastro" method="POST" action="cadastro.php" autocomplete="off">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>" placeholder="Seu nome" required><br><br>
        <label>CPF:</label><br>
        <input type="text" name="cpf" value="<?= htmlspecialchars($cpf) ?>" placeholder="CPF" required><br>
        <?php if ($cpfErro): ?><div class="erro"><?= $cpfErro ?></div><?php endif; ?><br>
        <label>Data de Nascimento:</label><br>
        <input type="date" name="data_nascimento" value="<?= htmlspecialchars($dataNascimento) ?>" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Seu e-mail" required><br>
        <?php if ($emailErro): ?><div class="erro"><?= $emailErro ?></div><?php endif; ?><br>
        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= htmlspecialchars($telefone) ?>" placeholder="Telefone" required><br>
        <?php if ($telefoneErro): ?><div class="erro"><?= $telefoneErro ?></div><?php endif; ?><br>
        <label>Endereço:</label><br>
        <input type="text" name="endereco" value="<?= htmlspecialchars($endereco) ?>" placeholder="Endereço" required><br><br>
        <button type="submit">Cadastrar</button>
      </form>
      <p>Já tem uma conta? <a href="login.php">Login</a></p>
    </div>
  </section>
</main>

<script src="assets/js/cadastro.js"></script>
<script src="assets/js/cpfValidator.js"></script>

<footer id="rodape">
  <p>&copy; <?= date('Y'); ?> DeliTech - by Sonley Foriste. Todos os direitos reservados.</p>
  <a href="http://facebook.com/sonley01" target="_blank">Facebook</a>
  <a href="http://instagram.com/__sssonleyyy" target="_blank">Instagram</a>
</footer>
</body>
</html>
