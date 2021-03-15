import { Table } from '../../../../Table/Table.js';
import { Filter } from '../../../../Filter/Filter.js';

let tabla_normativas = new Table({
    html: document.querySelector('.tab-content-list #tabla_normativas table'),
    cols: [
        {title: 'Título', data: 'titulo',},
        {title: 'Tipo de Normativa', data: 'tipo',},
        {title: 'Última vez actualizado', data: 'date',},
        {title: '', data: '', actions: ['file','more','edit','delete']},
    ],
    data: normativas.total.normativas,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});

let filtros_normativas = new Filter({
    id: 'normativas',
    order: {
        by: 'updated_at',
    }, limit: 10,
}, {}, [{
    target: 'id_tipo_normativa',
}, {
    target: 'obras',
}], normativas.total.normativas);

tabla_normativas.changeData(filtros_normativas.execute());

let filterCheckboxes = document.querySelectorAll(`.filter[data-target='obras']`);
for(const html of filterCheckboxes){
    html.addEventListener('change', function(e){
        e.preventDefault();
        tabla_normativas.changeData(filtros_normativas.execute());
    });
}

let filterButtons = document.querySelectorAll(`.filter[data-target='id_tipo_normativa']`);
for(const html of filterButtons){
    html.addEventListener('click', function(e){
        e.preventDefault();
        tabla_normativas.changeData(filtros_normativas.execute());
    });
}

export let seccion_normativas = {
    filtros: filtros_normativas,
    tabla: tabla_normativas,
};