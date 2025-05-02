<?php
// finalizar_pedido.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dadosCarrinho = json_decode(file_get_contents('php://input'), true);

    // Processar os dados do carrinho
    foreach ($dadosCarrinho as $item) {
        // Aqui você pode salvar os pedidos no banco de dados, por exemplo
        // Exemplo de inserção no banco (MySQL):
        // $nome = $item['nome'];
        // $preco = $item['preco'];
        // $quantidade = $item['quantidade'];
        // $query = "INSERT INTO pedidos (nome, preco, quantidade) VALUES ('$nome', '$preco', '$quantidade')";
        // mysql_query($query);
    }

    // Retorna uma resposta
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Pedido finalizado com sucesso!']);
}
?>
