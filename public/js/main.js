$(document).ready(function() {
    $('.sidenav').sidenav();
});

const d = document,
      notificacion = d.querySelector('#notificacion');

$(document).ready(function(){
  $('.datepicker').datepicker();
});

$(document).ready(function(){
  $('.slider').slider();
});

if(notificacion){
  notificacion.style.bottom = '.5rem';
  const i = d.querySelector('#notificacion i');
  i.onclick = cerrar;

  setInterval(function(){
    notificacion.style.bottom = '-10rem';

    clearInterval(this);
  }, 5000);
}

function cerrar(){
  this.parentNode.style.bottom = '-10rem';
}