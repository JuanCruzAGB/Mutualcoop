import { Table } from '../../../../Table/Table.js';

export let tabla_noticias = new Table({
    html: document.querySelector('.tab-content-list #tabla_noticias table'),
    cols: [
        {title: 'Título', data: 'titulo',},
        {title: '', data: '', actions: ['file','more','edit','delete']},
    ],
    data: noticias,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});