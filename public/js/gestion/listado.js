import { List } from "../List/List.js";
import { Filter } from "../../submodules/FilterJS/js/Filter.js";

function changeTableContent(params = undefined){
    params.list.changeData(params.data);
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
    if(gestiones.length){
        let list = new List({
            data: [],
        }, document.querySelector('#gestiones .lista-data'));

        let filtros = new Filter({
            id: 'gestiones',
            order: {
                by: 'updated_at',
            },
            limit: 10,
            event: {
                function: changeTableContent,
                params: {
                    list: list,
                },
            },
        }, {}, [{
            type: 'search',
            target: 'titulo,copete',
        },{
            type: 'button',
            target: 'id_tipo_gestion',
        }, {
            type: 'button',
            target: 'id_categoria',
        }, {
            type: 'checkbox',
            target: 'obras',
        }], gestiones);

        let newGestion = filtros.execute();
        list.changeData(newGestion);
        let nextBtn = document.querySelector('.filter-next');
        for (const gestion of newGestion) {
            nextBtn.href = `#gestion-${gestion.id_gestion}`;
        }

        document.querySelector('.filter-next').addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = this.href;
            let next = filtros.next();
            if(next){
                list.addRows(next.data);
                document.querySelector('#' + this.href.split('#')[1]).classList.add('previous');
                for (const gestion of next.data) {
                    nextBtn.href = `#gestion-${gestion.id_gestion}`;
                }
                if(!next.thereIsNext){
                    removeNextButton();
                }
            }else{
                removeNextButton();
            }
        });
    }else{
        console.error('No se encontraron Gestiones para mostrar.');
    }
});