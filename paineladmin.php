<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Exibir feedbacks
$sql = "SELECT f.mensagem, f.data_envio, c.nome FROM feedbacks f JOIN clientes c ON f.cliente_id = c.id ORDER BY f.data_envio DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head><title>Painel Administrativo</title></head>
<body>
    <h2>Painel do Administrador - DeliTech</h2>
    <p><a href="logout_admin.php">Sair</a></p>

    <h3>Feedbacks Recebidos:</h3>
    <?php while($row = $resultado->fetch_assoc()): ?>
        <p><strong><?php echo $row['nome']; ?>:</strong> <?php echo $row['mensagem']; ?> <em>(<?php echo $row['data_envio']; ?>)</em></p>
        <hr>
    <?php endwhile; ?>
</body>
</html>
