import { Table } from "../Table/Table.js";
import { Filter } from "../../submodules/FilterJS/js/Filter.js";
import { URL } from "../URL.js";
import { openModal } from "../modal/modal.js";

let actions = {
// ! Acción de editar.
    edit: {
        data: 'slug',
        url: '/panel/tema'
    },
// ! Acción de borrar.
    delete: {
        data: 'id_tema',
        url: '/tema'
} };

let cols = [ { 
    title: 'Nombre', data: 'nombre', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Tipo de Organismo', data: 'organismo', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { title: '', data: '{all},id_tema,slug', classNames: {
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
    if(temas.length){
        let tabla = new Table({
            cols: cols,
            data: [],
        }, document.querySelector('#tabla_temas table'));

        let filtros = new Filter({
            id: 'tabla_temas',
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
            target: 'nombre',
        },{
            type: 'button',
            target: 'id_organismo',
        },{
            type: 'checkbox',
            target: 'obras',
        }], temas);

        let newTems = filtros.execute();
        tabla.changeData(newTems);
        let nextBtn = document.querySelector('.filter-next');
        for (const tema of newTems) {
            nextBtn.href = `#tema-${tema.id_tema}`;
        }

        document.querySelector('.filter-next').addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = this.href;
            let next = filtros.next();
            if(next){
                tabla.addRows(next.data);
                document.querySelector('#' + this.href.split('#')[1]).classList.add('previous');
                for (const tema of next.data) {
                    nextBtn.href = `#tema-${tema.id_tema}`;
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
        console.error('No se encontraron Temas para mostrar.');
    }
});