import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
import { provincias } from "../provincias.js";

$(document).ready(function(){
    let alta_input = document.querySelector('#alta.datepicker-here');
    $('#alta.datepicker-here').datepicker({
        inline: true,
        dateFormat: 'yyyy-mm-dd',
        defaultDate: new Date(alta),
    });
    
    let baja_input = document.querySelector('#baja.datepicker-here');
    $('#baja.datepicker-here').datepicker({
        inline: true,
        dateFormat: 'yyyy-mm-dd',
        defaultDate: new Date(baja),
    });

    if(alta){
        $('#alta.datepicker-here').datepicker().data('datepicker').selectDate(new Date(alta));
    }
    if(baja){
        $('#baja.datepicker-here').datepicker().data('datepicker').selectDate(new Date(baja));
    }
});

function createOptions(){
    let provinciasSelect = document.querySelector('[name=provincia]');
    for(const localidad of provincias.provincias){
        let option = document.createElement('option');
        if(oldProvincia && oldProvincia == localidad.nombre){
            option.selected = true;
        }
        option.value = localidad.nombre;
        option.innerHTML = localidad.nombre;
        provinciasSelect.appendChild(option);
    }
}

document.addEventListener('DOMContentLoaded', function(e){
    createOptions();

    let btnAvanzado = document.querySelector('.avanzado-button');
    let avanzado = document.querySelector('.avanzado');
    
    btnAvanzado.addEventListener('click',function(e){
        e.preventDefault();
        if(avanzado.classList.contains('hidden')){
            avanzado.classList.remove('hidden');
            avanzado.classList.add('visible');
        }else if(!avanzado.classList.contains('hidden')){
            avanzado.classList.add('hidden');
            avanzado.classList.remove('visible');
        }
    })

    let see = document.querySelectorAll('.ver-password');
    for(const btn of see){
        btn.addEventListener('click', function(e){
            e.preventDefault();
            let input = this.previousElementSibling;
            switch(this.previousElementSibling.type){
                case 'password':
                    input.type = 'text';
                    this.children[0].classList.remove('fa-eye');
                    this.children[0].classList.add('fa-eye-slash');
                    break;
                case 'text':
                    input.type = 'password';
                    this.children[0].classList.remove('fa-eye-slash');
                    this.children[0].classList.add('fa-eye');
                    break;
            }
        });
    }

    let steps = document.querySelectorAll('.step');
    let stepsBtns = document.querySelectorAll('.step-button');
    for(const btn of stepsBtns){
        btn.addEventListener('click', function(e){
            e.preventDefault();
            for(const step of steps){
                if(step.classList.contains(this.href.split('#').pop())){
                    step.style.display = 'block';
                }else{
                    step.style.display = 'none';
                }
            }
        });
    }

    let nivelSelect = document.querySelector('[name=id_nivel]');
    let suscriptor = document.querySelector('.suscriptor');
    nivelSelect.addEventListener('change', function(e){
        if(this.value == 1){
            suscriptor.classList.remove('hidden');
            suscriptor.classList.add('block');
        }else{
            suscriptor.classList.remove('block');
            suscriptor.classList.add('hidden');
        }
    });

    if(oldNivel && oldNivel == 1){
        suscriptor.classList.remove('hidden');
        suscriptor.classList.add('block');
    }

    if(oldAvanzado){
        avanzado.classList.remove('hidden');
        avanzado.classList.add('visible');
    }

    new Validation({
        id: 'usuario-editar',
    },{
        submit: true,
    }, validation.rules, validation.messages);
});