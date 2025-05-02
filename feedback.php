<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['cliente_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_SESSION['cliente_id'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO feedbacks (cliente_id, mensagem) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $cliente_id, $mensagem);
    $stmt->execute();

    $confirmacao = "Feedback enviado com sucesso!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enviar Feedback - DeliTech</title>
</head>
<body>
    <h2>Feedback</h2>
    <?php if (isset($confirmacao)) echo "<p style='color:green;'>$confirmacao</p>"; ?>
    <form method="POST" action="">
        <label>Mensagem:</label><br>
        <textarea name="mensagem" rows="5" cols="50" required></textarea><br><br>
        <button type="submit">Enviar</button>
    </form>
    <p><a href="painel.php">Voltar ao painel</a></p>
</body>
</html>
