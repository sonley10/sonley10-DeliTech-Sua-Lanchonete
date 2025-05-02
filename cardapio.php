<?php


include 'conexão.php';    // Certifique-se que o arquivo conexao.php está na mesma pasta


// Conexão com o banco
$host = 'localhost'; 
$user = 'root'; 
$pass = ''; 
$dbname = 'delitech'; // <-- troque para o nome do seu banco
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Se receber o pedido via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pedido'])) {
    $pedido = json_decode($_POST['pedido'], true);

    // Variável para verificar se ocorreu erro no processo
    $erro = false;

    foreach ($pedido as $item) {
      $nome_item = $conn->real_escape_string($item['nome']);
      $preco_item = floatval($item['preco']);
      $imagem_item = $conn->real_escape_string($item['imagem']);
      $quantidade_item = intval($item['quantidade']);
  
      $sql = "INSERT INTO pedidos (nome_item, preco_item, imagem_item, quantidade_item) 
              VALUES ('$nome_item', $preco_item, '$imagem_item', $quantidade_item)";
  

        if (!$conn->query($sql)) {
            // Se der erro em algum pedido, marca como erro
            $erro = true;
            break;
        }
    }


    
    if ($erro) {
        echo "Erro ao gravar pedido: " . $conn->error;
    } else {
        echo "Pedido gravado com sucesso!";
    }

    // Fecha a conexão
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>DeliTech - Cardápio</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/cardapio.css">
</head>
<body>

<!-- Botão da Sacola -->
<div id="sacola-btn" class="sacola-botao">Sacola</div>

<!-- Painel Lateral da Sacola -->
<div id="painel-sacola" class="painel-sacola">
  <div class="painel-header">
    <h2>Minha Sacola</h2>
    <button id="fechar-sacola" class="fechar-btn" style="background:none;border:none;font-size:20px;cursor:pointer;">&times;</button>
  </div>

  <div id="itens-sacola" class="itens-sacola">
    <!-- Itens do carrinho -->
  </div>

  <div class="painel-footer">
    <div class="total-sacola">
      Total: R$ <span id="total-valor">0,00</span>
    </div>
    <button id="finalizar-pedido" class="btnAdicionar" style="width:100%;margin-top:10px;">Finalizar Pedido</button>
  </div>
</div>

<!-- Fundo escuro -->
<div id="overlay" class="overlay"></div>

<div class="container">
  <header>
    <h1>DeliTech</h1>
    <p class="bemvindo">Bem-vindo à melhor experiência de lanches online 🍔🚀</p>
    <nav>
    <a href="index.php">Início</a> 
        <a href="cardapio.php">Cardapio</a>
        <a href="contato.php">Fale-Conosco</a>
        <a href="sobre.php">Sobre</a>
        <a href="login.php">Login</a>
    </nav>
  </header>

  <main>
    <h1>🍽️ Cardápio DeliTech</h1>
    <div class="cardapio">
      <!-- Produtos -->

      <div class="item" data-nome="Pizza" data-preco="50.00">
  <img src="assets/img/pizza.jpg" alt="Pizza">
  <div class="info-produto">
    <h3>Pizza</h3>
    <p>R$ 50,00</p>
    <div style="margin-top:10px;">
      <input type="number" min="1" value="1" class="quantidade" style="width:50px; padding:5px; font-size:16px;">
      <button class="btnAdicionar" onclick="adicionarCarrinhoComQuantidade(this)">Adicionar</button>
    </div>
  </div>
</div>

<div class="item" data-nome="Hamburguer" data-preco="25.00">
  <img src="assets/img/burger1.jpg" alt="Hamburguer">
  <div class="info-produto">
    <h3>Hambúrguer</h3>
    <p>R$ 25,00</p>
    <div style="margin-top:10px;">
      <input type="number" min="1" value="1" class="quantidade" style="width:50px; padding:5px; font-size:16px;">
      <button class="btnAdicionar" onclick="adicionarCarrinhoComQuantidade(this)">Adicionar</button>
    </div>
  </div>
</div>

<div class="item" data-nome="Hamburguer1" data-preco="30.00">
  <img src="assets/img/burger2.jpg" alt="Hamburguer1">
  <div class="info-produto">
    <h3>Hambúrguer1</h3>
    <p>R$ 30,00</p>
    <div style="margin-top:10px;">
      <input type="number" min="1" value="1" class="quantidade" style="width:50px; padding:5px; font-size:16px;">
      <button class="btnAdicionar" onclick="adicionarCarrinhoComQuantidade(this)">Adicionar</button>
    </div>
  </div>
</div>

<div class="item" data-nome="Batata Frita" data-preco="15.00">
  <img src="assets/img/batata_frita.jpg" alt="Batata Frita">
  <div class="info-produto">
    <h3>Batata Frita</h3>
    <p>R$ 15,00</p>
    <div style="margin-top:10px;">
      <input type="number" min="1" value="1" class="quantidade" style="width:50px; padding:5px; font-size:16px;">
      <button class="btnAdicionar" onclick="adicionarCarrinhoComQuantidade(this)">Adicionar</button>
    </div>
  </div>
</div>

<div class="item" data-nome="Batata Frita1" data-preco="18.00">
  <img src="assets/img/batata_frita1.jpg" alt="Batata Frita1">
  <div class="info-produto">
    <h3>Batata Frita1</h3>
    <p>R$ 18,00</p>
    <div style="margin-top:10px;">
      <input type="number" min="1" value="1" class="quantidade" style="width:50px; padding:5px; font-size:16px;">
      <button class="btnAdicionar" onclick="adicionarCarrinhoComQuantidade(this)">Adicionar</button>
    </div>
  </div>
</div>

<div class="item" data-nome="Soda" data-preco="10.99">
  <img src="assets/img/soda.jpg" alt="Soda">
  <div class="info-produto">
    <h3>Soda</h3>
    <p>R$ 10,99</p>
    <div style="margin-top:10px;">
      <input type="number" min="1" value="1" class="quantidade" style="width:50px; padding:5px; font-size:16px;">
      <button class="btnAdicionar" onclick="adicionarCarrinhoComQuantidade(this)">Adicionar</button>
    </div>
  </div>
</div>

<div class="item" data-nome="Monster" data-preco="15.99">
  <img src="assets/img/monster.jpg" alt="Monster">
  <div class="info-produto">
    <h3>Monster</h3>
    <p>R$ 15,99</p>
    <div style="margin-top:10px;">
      <input type="number" min="1" value="1" class="quantidade" style="width:50px; padding:5px; font-size:16px;">
      <button class="btnAdicionar" onclick="adicionarCarrinhoComQuantidade(this)">Adicionar</button>
    </div>
  </div>
</div>
      <!-- Adicione mais produtos aqui -->
    </div>
  </main>

</div> <!-- Fecha container -->

<script src="assets/js/cardapio.js"></script>


</body>
</html>
