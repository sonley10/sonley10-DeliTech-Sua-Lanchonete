<?php
session_start();

if (!isset($_SESSION['cliente_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel - DeliTech</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>

    <p><a href="logout.php">Sair</a></p>

    <h3>Funções disponíveis:</h3>
    <ul>
        <li><a href="cardapio.php">Ver Cardápio</a></li>
        <li><a href="feedback.php">Enviar Feedback</a></li>
        <!-- Mais opções no futuro, como pedidos, relatórios etc -->
    </ul>
</body>
</html>
