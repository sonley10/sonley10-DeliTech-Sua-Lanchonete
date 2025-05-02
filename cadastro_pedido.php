<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pedido - DeliTech</title>
</head>
<body>
    <h2>Cadastrar Pedido</h2>
    <form action="salvar_pedido.php" method="POST">
        <label for="nome_item">Nome do Item:</label>
        <input type="text" name="nome_item" required><br><br>

        <label for="preco_item">Preço do Item (ex: 25.50):</label>
        <input type="number" step="0.01" name="preco_item" required><br><br>

        <input type="submit" value="Cadastrar Pedido">
    </form>
</body>
</html>
