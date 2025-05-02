const menu = document.querySelector('.menu-lateral');
const overlay = document.getElementById('overlay');
const abrirMenu = document.querySelector('.menu-icon');
const fecharMenu = document.querySelector('.fechar-menu');

abrirMenu.addEventListener('click', () => {
  menu.classList.add('ativo');
  overlay.classList.add('ativo');
  document.body.classList.add('menu-aberto');
});

fecharMenu.addEventListener('click', () => {
  menu.classList.remove('ativo');
  overlay.classList.remove('ativo');
  document.body.classList.remove('menu-aberto');
});

// Fecha o overlay se a tela for redimensionada para desktop
window.addEventListener('resize', () => {
  if (window.innerWidth >= 970) {
    menu.classList.remove('ativo');
    overlay.classList.remove('ativo');
    document.body.classList.remove('menu-aberto');
  }
});


