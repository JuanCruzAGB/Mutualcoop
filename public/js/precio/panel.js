import { Table } from "../Table/Table.js";

let actions = {
// ! Acción de editar.
    edit: {
        data: 'id_precio',
        url: '/panel/precio'
} };

let cols = [ { 
        title: 'Obra', data: 'id_obra', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Valor Anual', data: 'valor_anual', classNames: {
            th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Valor Mensual', data: 'valor_mensual', classNames: {
            th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Valor Semestral', data: 'valor_semestral', classNames: {
            th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { title: '', data: 'id_precio', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'text-center']
}, actions } ];

document.addEventListener('DOMContentLoaded', function(e){
    if(precios.length){
        let tabla = new Table({
            cols: cols,
            data: precios,
        }, document.querySelector('#tabla_precios table'));
    }else{
        console.error('No se encontraron Precios para mostrar.');
    }
});