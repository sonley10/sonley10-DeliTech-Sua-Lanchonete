let carrinho = [];

function adicionarCarrinhoComQuantidade(botao) {
    const item = botao.closest('.item');
    const nome = item.getAttribute('data-nome');
    const preco = parseFloat(item.getAttribute('data-preco'));
    const imagem = item.querySelector('img').src;
    const quantidadeInput = item.querySelector('.quantidade');
    const quantidade = parseInt(quantidadeInput.value);

    if (isNaN(quantidade) || quantidade <= 0) {
        alert('Por favor, insira uma quantidade válida.');
        return;
    }

    const existente = carrinho.find(produto => produto.nome === nome);

    if (!existente) {
        // Se o produto ainda não está no carrinho, adiciona
        carrinho.push({ nome, preco, imagem, quantidade });
        atualizarSacola();
    } else {
        // Produto já está na sacola
        if (existente.quantidade === quantidade) {
            alert('Esse produto já está na sacola.');
        } else {
            // Quantidade diferente: atualiza
            existente.quantidade = quantidade;
            atualizarSacola();
        }
    }
}



// Função para atualizar os itens na sacola
function atualizarSacola() {
    const itensSacola = document.getElementById('itens-sacola');
    itensSacola.innerHTML = '';
    let total = 0;

    carrinho.forEach((produto, index) => {
        const subtotal = produto.preco * produto.quantidade;
        total += subtotal;

        const div = document.createElement('div');
        div.className = 'produtoCarrinho';
        div.innerHTML = `
            <img src="${produto.imagem}" style="width:50px;height:50px;border-radius:5px;margin-right:10px;">
            <strong>${produto.nome}</strong><br>
            R$ ${(produto.preco).toFixed(2)} x 
            <input type="number" min="1" value="${produto.quantidade}" onchange="atualizarQuantidade(${index}, this)" style="width:40px;">
            = <strong>R$ ${(subtotal).toFixed(2)}</strong>
            <button onclick="removerItem(${index})" style="background:red;color:white;border:none;border-radius:5px;padding:2px 6px;margin-left:10px;cursor:pointer;">X</button>
        `;
        itensSacola.appendChild(div);
    });

    document.getElementById('total-valor').textContent = total.toFixed(2);
}

// Função para atualizar a quantidade de um produto na sacola
function atualizarQuantidade(index, input) {
    const novaQuantidade = parseInt(input.value);
    if (novaQuantidade > 0) {
        carrinho[index].quantidade = novaQuantidade;
    } else {
        carrinho.splice(index, 1);
    }
    atualizarSacola();
}

// Função para remover item da sacola
function removerItem(index) {
    carrinho.splice(index, 1);
    atualizarSacola();
}

// Função para abrir a sacola
function abrirSacola() {
    document.getElementById('painel-sacola').classList.add('aberto');
    document.getElementById('overlay').style.display = 'block';
}

// Função para fechar a sacola
document.getElementById('fechar-sacola').addEventListener('click', () => {
    document.getElementById('painel-sacola').classList.remove('aberto');
    document.getElementById('overlay').style.display = 'none';
});

// Fechar a sacola ao clicar na overlay
document.getElementById('overlay').addEventListener('click', () => {
    document.getElementById('painel-sacola').classList.remove('aberto');
    document.getElementById('overlay').style.display = 'none';
});

document.getElementById('finalizar-pedido').addEventListener('click', () => {
    if (carrinho.length === 0) {
        alert('Sua sacola está vazia!');
    } else {
        alert('Pedido finalizado com sucesso! Obrigado por comprar na DeliTech 🚀🍔');
        carrinho = [];
        atualizarSacola();
        document.getElementById('painel-sacola').classList.remove('aberto');
        document.getElementById('overlay').style.display = 'none';
    }
});

// Abrir a sacola clicando no botão
document.getElementById('sacola-btn').addEventListener('click', abrirSacola);
