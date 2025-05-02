<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .btn-voltar {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-voltar:hover {
            background-color: #218838;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 30px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        .sucesso {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>📋 Lista de Pedidos</h2>

    <a class="btn-voltar" href="cadastro_pedido.php">➕ Cadastrar Novo Pedido</a>

    <?php
    $conn = new mysqli("localhost", "root", "", "delitech");

    if ($conn->connect_error) {
        die("❌ Erro na conexão: " . $conn->connect_error);
    }

    $sql = "SELECT id, nome_item, preco_item, data_pedido FROM pedidos ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<p class='sucesso'>✅ Pedidos encontrados com sucesso!</p>";
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nome do Item</th>
                    <th>Preço (R$)</th>
                    <th>Data do Pedido</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome_item']}</td>
                    <td>R$ " . number_format($row['preco_item'], 2, ',', '.') . "</td>
                    <td>{$row['data_pedido']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>⚠️ Nenhum pedido cadastrado ainda.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
