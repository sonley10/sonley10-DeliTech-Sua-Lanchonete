function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
  
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
  
    let soma = 0;
    for (let i = 0; i < 9; i++) {
      soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;
  
    soma = 0;
    for (let i = 0; i < 10; i++) {
      soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(10))) return false;
  
    return true;
  }
  
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formCadastro');
    const cpfInput = form.querySelector('input[name="cpf"]');
  
    form.addEventListener('submit', function (e) {
      const cpf = cpfInput.value;
  
      if (!validarCPF(cpf)) {
        e.preventDefault();
  
        let erro = cpfInput.nextElementSibling;
        if (!erro || !erro.classList.contains('erro')) {
          erro = document.createElement('div');
          erro.classList.add('erro');
          cpfInput.after(erro);
        }
  
        erro.textContent = "CPF inválido.";
        cpfInput.focus();
      }
    });
  });

  document.querySelector('input[name="cpf"]').addEventListener('blur', function () {
    const cpf = this.value.replace(/\D/g, '');
    if (cpf.length === 11) {
        fetch('verificar_cpf.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'cpf=' + cpf
        })
        .then(response => response.json())
        .then(data => {
            if (data.status !== 'OK') {
                alert('CPF inválido ou não encontrado.');
                return;
            }

            const nomeInformado = document.querySelector('input[name="nome"]').value.trim().toLowerCase();
            const dataNascimentoInformada = document.querySelector('input[name="data_nascimento"]').value;
            const nomeAPI = (data.nome || '').trim().toLowerCase();
            const nascimentoAPI = data.data_nascimento;

            if (nomeInformado !== nomeAPI || dataNascimentoInformada !== nascimentoAPI) {
                alert("Nome ou data de nascimento não correspondem ao CPF informado.");
            } else {
                console.log("Dados verificados com sucesso!");
            }
        })
        .catch(error => {
            console.error("Erro ao verificar CPF:", error);
        });
    }
});