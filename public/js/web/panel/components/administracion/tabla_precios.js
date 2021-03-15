import { Table } from '../../../../Table/Table.js';

export let tabla_precios = new Table({
    html: document.querySelector('.tab-content-list #tabla_precios table'),
    cols: [
        {title: 'Obra', data: 'id_obra',},
        {title: 'Valor Anual', data: 'valor_anual',},
        {title: 'Valor Semestral', data: 'valor_semestral',},
        {title: '', data: '', actions: ['edit']},
    ],
    data: precios,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});