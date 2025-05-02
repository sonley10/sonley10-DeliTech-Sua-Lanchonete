<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "delitech";

// Conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Pega os dados do POST
$nome = $_POST['nome'];
$preco = $_POST['preco'];

// Prepara o SQL (corrigido)
$stmt = $conn->prepare("INSERT INTO pedidos (nome_item, preco_item) VALUES (?, ?)");
$stmt->bind_param("sd", $nome, $preco); // "s" = string, "d" = double (decimal)

// Executa o comando
if ($stmt->execute()) {
    echo "Pedido adicionado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

// Fecha conexão
$stmt->close();
$conn->close();
?>
