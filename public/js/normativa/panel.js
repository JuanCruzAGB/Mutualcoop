import { Table } from "../Table/Table.js";
import { Filter } from "../../submodules/FilterJS/js/Filter.js";
import { URL } from "../URL.js";
import { openModal } from "../modal/modal.js";

for (const normativa of normativas) {
    normativa.minified = normativa.copete.replace(/<(.*?)>/, '').substr(0, 100) + '...';
    if(normativa.minified == '...'){
        normativa.minified = null;
    }
}

let actions = {
// ! Acción de ver archivo.
    file: {
        data: 'archivo',
    },
// ! Acción de editar.
    edit: {
        data: 'slug',
        url: '/panel/normativa'
    },
// ! Acción de borrar.
    delete: {
        data: 'id_normativa',
        url: '/normativa'
} };

let cols = [ { 
        title: 'Título', data: 'titulo', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Copete', data: 'minified', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Tipo de Normativa', data: 'tipo_normativa', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { title: '', data: 'archivo,id_normativa,slug', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'text-center']
}, actions } ];

function changeTableContent(params = undefined){
    params.tabla.changeData(params.data);
    addNextButton();
}

function addNextButton(){
    const nextBtn = document.querySelector('.filter-next');
    nextBtn.style.display = 'inline-flex';

    let parent = nextBtn.parentNode;

    if(document.querySelector('.filter-next + p')){
        parent.removeChild(document.querySelector('.filter-next + p'));
    }
}

function removeNextButton(){
    const nextBtn = document.querySelector('.filter-next');
    nextBtn.style.display = 'none';

    let parent = nextBtn.parentNode;

    let paragraph = document.createElement('p');
    paragraph.innerHTML = 'No se encontraron resultados';
    paragraph.classList.add('text-gray-600');
    parent.appendChild(paragraph);
}

document.addEventListener('DOMContentLoaded', function(e){
    if(normativas.length){
        let tabla = new Table({
            cols: cols,
            data: [],
        }, document.querySelector('#tabla_normativas table'));

        let filtros = new Filter({
            id: 'tabla_normativas',
            order: {
                by: 'updated_at',
            },
            limit: 10,
            event: {
                function: changeTableContent,
                params: {
                    tabla: tabla,
                },
            },
        }, {}, [{
            type: 'search',
            target: 'titulo,copete',
        },{
            type: 'button',
            target: 'id_tipo_normativa',
        }, {
            type: 'checkbox',
            target: 'temas',
        }, {
            type: 'checkbox',
            target: 'obras',
        }], normativas);

        let newNormativas = filtros.execute();
        tabla.changeData(newNormativas);
        let nextBtn = document.querySelector('.filter-next');
        for (const normativa of newNormativas) {
            nextBtn.href = `#normativa-${normativa.id_normativa}`;
        }

        document.querySelector('.filter-next').addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = this.href;
            let next = filtros.next();
            if(next){
                tabla.addRows(next.data);
                document.querySelector('#' + this.href.split('#')[1]).classList.add('previous');
                for (const normativa of next.data) {
                    nextBtn.href = `#normativa-${normativa.id_normativa}`;
                }
                if(!next.thereIsNext){
                    removeNextButton();
                }
            }else{
                removeNextButton();
            }
        });

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
                addNextButton();
            });
        }
    }else{
        console.error('No se encontraron Normativas para mostrar.');
    }
});