import { Table } from '../../../../Table/Table.js';

export let tabla_educaciones = new Table({
    html: document.querySelector('.tab-content-list #tabla_educaciones table'),
    cols: [
        {title: 'Título', data: 'titulo',},
        {title: 'Última vez actualizado', data: 'date',},
        {title: '', data: '', actions: ['file','more','edit','delete']},
    ],
    data: educaciones,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});