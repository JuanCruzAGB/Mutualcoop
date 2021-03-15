import { Table } from '../../../../Table/Table.js';
import { Filter } from '../../../../Filter/Filter.js';

let tabla_facturaciones = new Table({
    html: document.querySelector('.tab-content-list #tabla_facturaciones table'),
    cols: [
        {title: 'Número de Suscriptor', data: 'id_suscriptor',},
        {title: 'Nombre', data: 'nombre',},
        {title: 'Entidad', data: 'entidad',},
        {title: 'Provincia', data: 'provincia',},
        {title: 'Tipo de Suscripcion', data: 'id_tipo_suscripcion',},
        {title: 'Obras', data: 'obras',},
        {title: 'Valor', data: 'valor_original',},
    ],
    data: facturaciones,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});

let filtros_facturaciones = new Filter({
    id: 'facturaciones',
    order: {
        by: 'id_suscriptor',
    },
}, {}, [{
    target: 'fecha',
    value: document.querySelector(`select.filter[data-target="alta"]`).value,
}], facturaciones);

tabla_facturaciones.changeData(executedData);

createTotalValue(executedData);

function changeSelectValue(value){
    let select = document.querySelector(`select.filter[data-target]`);
    let optSelected;
    for(const option of select.children){
        option.selected = false;
        if(option.value == value){
            optSelected = option;
        }
    }
    if(optSelected){
        optSelected.selected = true;
        changeButtonValue();
        let data = filtros_eventos.execute();
        tabla_eventos.changeData(data);
        createTotalValue(data);
    }
}

function changeButtonValue(){
    let buttons = document.querySelectorAll(`button.filter[data-target="alta"]`);
    let select = document.querySelector(`select.filter[data-target="alta"]`);
    for(const btn of buttons){
        if(btn.classList.contains('left')){
            if(parseInt(select.value.split('(-').pop().split('-)').shift()) > 1){
                let number = (parseInt(select.value.split('(-').pop().split('-)').shift()) - 1);
                if(number < 10){
                    number = '0' + number;
                }
                btn.value = '(-' + number + '-)';
            }else{
                btn.value = '(-12-)';
            }
        }else{
            if(parseInt(select.value.split('(-').pop().split('-)').shift()) < 12){
                let number = (parseInt(select.value.split('(-').pop().split('-)').shift()) + 1);
                if(number < 10){
                    number = '0' + number;
                }
                btn.value = '(-' + number + '-)';
            }else{
                btn.value = '(-01-)';
            }
        }
    }
}

function createTotalValue(data){
    if(data.length){
        let empty = document.createElement('tr');
        empty.classList.add('empty');
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        tabla_facturaciones.appendTr(empty);
            let td = document.createElement('td');
            empty.appendChild(td);
            td.classList.add('total', 'px-4', 'py-2');
                let span = document.createElement('span');
                td.appendChild(span);
                let value = 0;
                for(const usuario of data){
                    value += usuario.valor_original;
                }
                span.innerHTML = '$' + value;
    }
}

let buttons = document.querySelectorAll(`.fecha`);
for(const html of buttons){
    html.addEventListener('click', function(e){
        e.preventDefault();
        changeSelectValue(this.value);
    });
}

let select = document.querySelector(`select.filter[data-target="alta"]`);
select.addEventListener('change', function(e){
    changeButtonValue();
    let data = filtros_eventos.execute();
    tabla_eventos.changeData(data);
    createTotalValue(data);
});

// let filterSwitch = document.querySelectorAll(`.filter[data-target='privado']`);
// for(const html of filterButtons){
//     for(const target of html.dataset.target.split(',')){
//         html.addEventListener('change', function(e){
//             tabla_eventos.changeData(filtros_eventos.execute());
//         });
//     }
// }

export let seccion_facturaciones = {
    filtros: filtros_facturaciones,
    tabla: tabla_facturaciones,
};