import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
$(document).ready(function(){
    let datepicker = document.querySelector('.datepicker-here');
    $('.datepicker-here').datepicker({
        inline: true,
        dateFormat: 'yyyy-mm-dd',
        defaultDate: new Date(fecha),
    });

    if(fecha){
        $('.datepicker-here').datepicker().data('datepicker').selectDate(new Date(fecha));
    }
});

document.addEventListener('DOMContentLoaded', function(e){
    new Validation({
        id: 'evento-editar',
    },{
        submit: true,
    }, validation.rules, validation.messages);
});