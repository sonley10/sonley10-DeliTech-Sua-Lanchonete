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
    <style>
        .pedido {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .pedido img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 8px;
        }
        .pedido-info {
            flex: 1;
        }
        .pedido-info h3, .pedido-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<h1>Pedidos Realizados</h1>

<?php
if ($resultado->num_rows > 0) {
    while($linha = $resultado->fetch_assoc()) {
        echo "<div class='pedido'>";

        // Verifica se a imagem existe, senão usa a imagem padrão
        $imagem = !empty($linha['imagem_item']) ? $linha['imagem_item'] : 'semfoto.png';

        echo "<img src='assets/img/" . htmlspecialchars($imagem) . "' alt='Imagem do Pedido'>";


        echo "<div class='pedido-info'>";
        echo "<h3>" . htmlspecialchars($linha['nome_item']) . "</h3>";
        echo "<p>Preço: R$ " . number_format($linha['preco_item'], 2, ',', '.') . "</p>";
        echo "<p>Data do Pedido: " . date('d/m/Y H:i', strtotime($linha['data_pedido'])) . "</p>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "<p class='sem-pedidos'>Nenhum pedido realizado.</p>";
}

// Fecha a conexão
$conn->close();
?>

<a href="cardapio.php" class="botao-voltar">Voltar ao Cardápio</a>

</body>
</html>
