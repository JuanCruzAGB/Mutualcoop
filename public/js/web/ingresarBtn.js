document.addEventListener('DOMContentLoaded', function(){
    const iniciarBtn = d.querySelector('.iniciarIndex');
    const formularioIngreso = d.querySelector('.ingresar');
    const formRow = d.querySelector('.formRow');
    const header = d.querySelector('header');

    
    iniciarBtn.addEventListener('click', function(evento){
        evento.preventDefault();
        if(formularioIngreso.style.display == 'none' || formularioIngreso.style.display == ''){
            formularioIngreso.style.display = "block";
            formRow.style.height = "5rem";
        }else{
            formularioIngreso.style.display = "none";
            header.style.height = "5rem !important";
            formRow.style.height = "0";
        }
    });
});