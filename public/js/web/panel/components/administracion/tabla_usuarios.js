import { Table } from '../../../../Table/Table.js';
import { Filter } from '../../../../Filter/Filter.js';

let tabla_usuarios = new Table({
    html: document.querySelector('.tab-content-list #tabla_usuarios table'),
    cols: [
        {title: '', data: 'estado',},
        {title: 'N° de Suscriptor', data: 'id_suscriptor',},
        {title: 'Correo', data: 'correo',},
        {title: 'Entidad', data: 'entidad',},
        {title: 'Última vez actualizado', data: 'date',},
        {title: '', data: '', actions: ['more','edit','delete']},
    ],
    data: usuarios,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});

let filtros_usuarios = new Filter({
    id: 'usuarios',
    order: {
        by: 'id_suscriptor',
    }, limit: 10,
}, {}, [{
    target: 'id_nivel',
}], usuarios);

tabla_usuarios.changeData(filtros_usuarios.execute());

let filterButtons = document.querySelectorAll(`.filter[data-target='id_nivel']`);
for(const html of filterButtons){
    html.addEventListener('click', function(e){
        e.preventDefault();
        tabla_usuarios.changeData(filtros_usuarios.execute());
    });
}

export let seccion_usuarios = {
    filtros: filtros_usuarios,
    tabla: tabla_usuarios,
};