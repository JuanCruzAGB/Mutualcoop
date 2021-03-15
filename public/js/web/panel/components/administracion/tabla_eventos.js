import { Table } from '../../../../Table/Table.js';
import { Filter } from '../../../../Filter/Filter.js';

let tabla_eventos = new Table({
    html: document.querySelector('.tab-content-list #tabla_eventos table'),
    cols: [
        {title: '', data: 'privado',},
        {title: 'Título', data: 'titulo',},
        {title: 'Fecha', data: 'fecha',},
        {title: '', data: '', actions: ['file','more','edit','delete']},
    ],
    data: eventos,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});

let filtros_eventos = new Filter({
    id: 'eventos',
    order: {
        by: 'fecha',
    }, limit: 10,
}, {}, [], eventos);

tabla_eventos.changeData(filtros_eventos.execute());

export let seccion_eventos = {
    filtros: filtros_eventos,
    tabla: tabla_eventos,
};