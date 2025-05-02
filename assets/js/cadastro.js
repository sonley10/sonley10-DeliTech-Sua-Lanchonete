document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formCadastro');
  let isFormChanged = false;

  // Verifica se cadastro foi concluído e limpa os campos
  const sucesso = localStorage.getItem('cadastroSucesso') === 'true';
  if (form && sucesso) {
    form.reset(); // limpa todos os campos do formulário
    localStorage.removeItem('cadastroSucesso');
  }

  // Detecta mudanças no formulário
  form.addEventListener('input', () => {
    isFormChanged = true;
  });

  // Impede recarregamento com aviso, se houver mudanças
  window.addEventListener('beforeunload', (e) => {
    if (isFormChanged) {
      e.preventDefault();
      e.returnValue = '';
    }
  });

  // Ao enviar, não exibe o aviso de saída
  form.addEventListener('submit', () => {
    isFormChanged = false;
  });
});
