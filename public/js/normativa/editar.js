import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
function createOption(temasToPush = []){
    let temasSelect = document.querySelector('[name="temas[]"]');
    temasSelect.innerHTML = '';
    let defaultOption = document.createElement('option');
    defaultOption.disabled = true;
    temasSelect.appendChild(defaultOption);
    if(temasToPush.length){
        defaultOption.innerHTML = 'Tema *';
        for(const tema of temasToPush){
            let option = document.createElement('option');
            option.value = tema.id_tema;
            option.innerHTML = tema.nombre;
            if(oldTemas && oldTemas.length){
                for(const oldTema of oldTemas){
                    if(tema.id_tema == oldTema){
                        option.selected = true;
                    }
                }
            }
            temasSelect.appendChild(option);
        }
    }else{
        defaultOption.innerHTML = 'Tema *: Seleccione algún Organismo y una Obra primero';
    }
}

function setTemas(obras = [], id_organismo = undefined){
    if(obras.length && id_organismo){
        let auxData = [];
        for(const tema of temas){
            for(const nexo of tema.nexos){
                for(const obra of obras){
                    if(nexo.id_obra == obra.value && tema.id_organismo == id_organismo){
                        if(auxData.indexOf(tema) === -1){
                            auxData.push(tema);
                        }
                    }
                }
            }
        }
        createOption(auxData);
    }else{
        createOption();
    }
}

document.addEventListener('DOMContentLoaded', function(){
    let obrasCheckboxes = document.querySelectorAll('.obra');
    for(const obra of obrasCheckboxes){
        obra.addEventListener('change', function(e){
            let checked = [];
            let organismosSelect = document.querySelector('[name=id_organismo]');
            for(const obra of obrasCheckboxes){
                if(obra.checked){
                    checked.push(obra);
                }
            }
            if(checked.length && organismosSelect.value >= 1){
                setTemas(checked, organismosSelect.value);
            }else{
                setTemas();
            }
        });
    }

    let organismosSelect = document.querySelector('[name=id_organismo]');
    organismosSelect.addEventListener('change', function(e){
        let checked = [];
        for(const obra of obrasCheckboxes){
            if(obra.checked){
                checked.push(obra);
            }
        }
        if(checked.length && this.value >= 1){
            setTemas(checked, this.value);
        }else{
            setTemas();
        }
    });

    if(typeof oldObras == 'object'){
        let checked = [];
        for(const obra_key in oldObras){
            if(oldObras.hasOwnProperty(obra_key)){
                const obra_value = oldObras[obra_key];
                checked.push({value: obra_value});
            }
        }
        if(organismosSelect.value >= 1, checked.length){
            setTemas(checked, organismosSelect.value);
        }else{
            setTemas();
        }
    }

    new Validation({
        id: 'normativa-editar',
    },{
        submit: true,
    }, validation.rules, validation.messages);
});

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