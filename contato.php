<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contato - DeliTech</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/contato.css">

</head>
<body>

<header>
    <h1>DeliTech</br></h1>
    <p class="bemvindo">Bem-vindo à melhor experiência de lanches online 🍔🚀</p>
    <nav>
    <a href="index.html">Início</a> 
        <a href="cardapio.php">Cardapio</a>
        <a href="contato.php">Fale-Conosco</a>
        <a href="sobre.php">Sobre</a>
        <a href="login.php">Login</a>
    </nav>
  </header>
<main>
  <section>
  <div class="container">
    <h2>Entre em Contato</h2>
    <form action="envia_contato.php" method="post">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" required>

      <label for="mensagem">Mensagem:</label>
      <textarea id="mensagem" name="mensagem" rows="5" required></textarea>

      <button type="submit">Enviar</button>
    
    <a href="https://wa.me/5511952190450?text=Olá%20gostaria%20de%20fazer%20um%20pedido!" target="_blank" class="whatsapp-button">
      Fale conosco pelo WhatsApp
    </a>
    </form>
  </div>
  </section>
</main>
 

  <footer id="rodape">
  <p>&copy; <?php echo date('Y'); ?> DeliTech - by Sonley Foriste. Todos os direitos reservados.</p>
     <a href="http://facebook.com/sonley01" target="_blank"> Facebook </a>
     <a href="http://instagram.com/__sssonleyyy" target="_blank">Instagram </a> </p>
</footer>

</body>
</html>
