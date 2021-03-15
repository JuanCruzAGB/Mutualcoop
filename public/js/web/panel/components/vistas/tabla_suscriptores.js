import { Table } from '../../../../Table/Table.js';
import { Filter } from '../../../../Filter/Filter.js';

export let tabla_suscriptores = new Table({
    html: document.querySelector('.tab-content-list #tabla_suscriptores table'),
    cols: [
        {title: 'N° de Suscriptor', data: 'id_suscriptor',},
        {title: 'Nombre', data: 'nombre',},
        {title: 'Correo', data: 'correo',},
        {title: 'Entidad', data: 'entidad',},
        {title: 'Teléfono', data: 'telefono',},
        {title: 'Cuit/Cuil', data: 'cuit_cuil',},
        {title: 'Tipo de Suscripción', data: 'id_tipo_suscripcion',},
        {title: 'Obras Suscriptas', data: 'obras',},
    ],
    data: suscriptores,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});