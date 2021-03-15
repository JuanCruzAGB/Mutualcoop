import { Table } from '../../../../Table/Table.js';
import { Filter } from '../../../../Filter/Filter.js';

let tabla_gestiones = new Table({
    html: document.querySelector('.tab-content-list #tabla_gestiones table'),
    cols: [
        {title: 'Título', data: 'titulo',},
        {title: 'Tipo de Gestión', data: 'tipo',},
        {title: 'Última vez actualizado', data: 'date',},
        {title: '', data: '', actions: ['file','more','edit','delete']},
    ],
    data: gestiones.total.gestiones,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});

let filtros_gestiones = new Filter({
    id: 'gestiones',
    order: {
        by: 'updated_at',
    }, limit: 10,
}, {}, [{
    target: 'id_tipo_gestion',
}, {
    target: 'obras',
}], gestiones.total.gestiones);

tabla_gestiones.changeData(filtros_gestiones.execute());

let filterCheckboxes = document.querySelectorAll(`.filter[data-target='obras']`);
for(const html of filterCheckboxes){
    html.addEventListener('change', function(e){
        e.preventDefault();
        tabla_gestiones.changeData(filtros_gestiones.execute());
    });
}

let filterButtons = document.querySelectorAll(`.filter[data-target='id_tipo_gestion']`);
for(const html of filterButtons){
    html.addEventListener('click', function(e){
        e.preventDefault();
        tabla_gestiones.changeData(filtros_gestiones.execute());
    });
}

export let seccion_gestiones = {
    filtros: filtros_gestiones,
    tabla: tabla_gestiones,
};