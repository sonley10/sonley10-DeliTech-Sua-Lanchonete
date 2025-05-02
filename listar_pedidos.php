<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "delitech";

// Conexão
$conn = new mysqli($servername, $username, $password, $database);

// Testar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Buscar pedidos
$resultado = $conn->query("SELECT * FROM pedidos");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos Realizados - DeliTech</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/pedido.css">
</head>
<body>

<h1>Pedidos Realizados</h1>

<?php
if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nome do Produto</th><th>Preço</th></tr>";
    while($linha = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($linha['nome_item']) . "</td>";  // Corrigido aqui
        echo "<td>R$ " . number_format($linha['preco_item'], 2, ',', '.') . "</td>"; // Corrigido aqui
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p class='sem-pedidos'>Nenhum pedido realizado.</p>";
}

// Fecha a conexão depois de tudo
$conn->close();
?>

<a href="cardapio.php" class="botao-voltar">Voltar ao Cardápio</a>

</body>
</html>
