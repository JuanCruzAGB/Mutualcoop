import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
function createOption(input = undefined, dataToPush = []){
    let defaultOption = document.createElement('option');
    defaultOption.selected = true;
    defaultOption.disabled = true;
    switch(input){
        case 'id_tipo_gestion':
            let tiposSelect = document.querySelector('[name=id_tipo_gestion]');
            tiposSelect.innerHTML = '';
            tiposSelect.appendChild(defaultOption);
            if(dataToPush.length){
                defaultOption.innerHTML = 'Tipo de Gestión *';
                for(const data of dataToPush){
                    let option = document.createElement('option');
                    option.value = data.id_tipo;
                    option.innerHTML = data.nombre;
                    if(oldTipo && data.id_tipo == oldTipo){
                        option.selected = true;
                        if(defaultOption.selected){
                            defaultOption.selected = false;
                        }
                    }
                    tiposSelect.appendChild(option);
                }
            }else{
                defaultOption.innerHTML = 'Tipo de Gestión *: Seleccione alguna Obra primero';
            }
            break;
        case 'id_categoria':
            let categoriasSelect = document.querySelector('[name=id_categoria]');
            categoriasSelect.innerHTML = '';
            categoriasSelect.appendChild(defaultOption);
            if(dataToPush.length){
                defaultOption.innerHTML = 'Categoría';
                for(const data of dataToPush){
                    let option = document.createElement('option');
                    option.value = data.id_categoria;
                    option.innerHTML = data.nombre;
                    if(oldCategoria && data.id_categoria == oldCategoria){
                        option.selected = true;
                        if(defaultOption.selected){
                            defaultOption.selected = false;
                        }
                    }
                    categoriasSelect.appendChild(option);
                }
            }else{
                defaultOption.innerHTML = 'Categoría: Seleccione alguna Gestión y una Obra primero';
            }
            break;
    }
}

function setTipo(obras = []){
    if(obras.length){
        let auxData = [];
        for(const tipo of tipos){
            for(const conexion of tipo.conexiones){
                for(const obra of obras){
                    if(conexion.id_obra == obra.value){
                        if(auxData.indexOf(tipo) === -1){
                            auxData.push(tipo);
                        }
                    }
                }
            }
        }
        createOption('id_tipo_gestion', auxData);
    }else{
        createOption('id_tipo_gestion');
    }
}

function setCategoria(obras = [], id_tipo_gestion = undefined){
    if(id_tipo_gestion){
        let auxData = [];
        for(const categoria of categorias){
            for(const union of categoria.uniones){
                for(const obra of obras){
                    if(union.id_obra == obra.value && categoria.id_tipo_gestion == id_tipo_gestion){
                        if(auxData.indexOf(categoria) === -1){
                            auxData.push(categoria);
                        }
                    }
                }
            }
        }
        createOption('id_categoria', auxData);
    }else{
        createOption('id_categoria');
    }
}

document.addEventListener('DOMContentLoaded', function(){
    let obrasCheckboxes = document.querySelectorAll('.obra');
    for(const obra of obrasCheckboxes){
        obra.addEventListener('change', function(e){
            let checked = [];
            let tiposSelect = document.querySelector('[name=id_tipo_gestion]');
            for(const obra of obrasCheckboxes){
                if(obra.checked){
                    checked.push(obra);
                }
            }
            if(checked.length){
                setTipo(checked);
                if(tiposSelect.value >= 1){
                    setCategoria(checked, tiposSelect.value);
                }else{
                    setCategoria();
                }
            }else{
                setTipo();
            }
        });
    }

    let tiposSelect = document.querySelector('[name=id_tipo_gestion]');
    tiposSelect.addEventListener('change', function(e){
        let checked = [];
        for(const obra of obrasCheckboxes){
            if(obra.checked){
                checked.push(obra);
            }
        }
        if(checked.length && this.value >= 1){
            setCategoria(checked, this.value);
        }else{
            setCategoria();
        }
    });

    if(typeof oldObras == 'object'){
        let checked = [];
        for(const obra_name in oldObras){
            const obra_value = oldObras[obra_name];
            checked.push({value: obra_value})
        }
        if(checked.length){
            setTipo(checked);
            if(tiposSelect.value >= 1){
                setCategoria(checked, tiposSelect.value);
            }else{
                setCategoria();
            }
        }else{
            setTipo();
        }
    }

    new Validation({
        id: 'gestion-crear',
    },{
        submit: true,
    }, validation.rules, validation.messages);
});