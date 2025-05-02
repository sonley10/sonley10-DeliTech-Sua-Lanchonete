<?php
session_start();
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Simples, você pode guardar esses dados direto na tabela `admins`
    if ($usuario === "admin" && $senha === "1234") {
        $_SESSION['admin'] = true;
        header("Location: painelAdmin.php");
        exit;
    } else {
        $erro = "Credenciais inválidas!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login Admin</title></head>
<body>
    <h2>Login do Administrador</h2>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="POST">
        <label>Usuário:</label><br>
        <input type="text" name="usuario"><br><br>
        <label>Senha:</label><br>
        <input type="password" name="senha"><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
