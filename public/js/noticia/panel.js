import { Table } from "../Table/Table.js";
import { Filter } from "../../submodules/FilterJS/js/Filter.js";

let actions = {
// ! Acción de ver archivo.
    file: {
        data: 'archivo',
    },
// ! Acción de editar.
    edit: {
        data: 'slug',
        url: '/panel/noticia'
    },
// ! Acción de borrar.
    delete: {
        data: 'id_noticia',
        url: '/noticia'
} };

let cols = [ { 
    title: 'Título', data: 'titulo', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { title: '', data: 'archivo,id_noticia,slug', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'text-center']
}, actions } ];

function changeTableContent(params = undefined){
    params.tabla.changeData(params.data);
}

document.addEventListener('DOMContentLoaded', function(e){
    if(noticias.length){
        let tabla = new Table({
            cols: cols,
            data: [],
        }, document.querySelector('#tabla_noticias table'));

        let filtros = new Filter({
            id: 'tabla_noticias',
            order: {
                by: 'updated_at',
            },
            event: {
                function: changeTableContent,
                params: {
                    tabla: tabla,
                },
            },
        }, {}, [{
            type: 'search',
            target: 'titulo',
        }], noticias);

        tabla.changeData(filtros.execute());

        let orderBtns = document.querySelectorAll('.filter-order');
        for (const btn of orderBtns) {
            btn.addEventListener('click', function(e){
                e.preventDefault();
                filtros.changeOrder({
                    by: this.dataset.by,
                    type: this.dataset.type,
                });
                if(this.dataset.type == 'DESC'){
                    this.dataset.type = 'ASC';
                }else{
                    this.dataset.type = 'DESC';
                }
                tabla.changeData(filtros.execute());
            });
        }
    }else{
        console.error('No se encontraron Noticias para mostrar.');
    }
});