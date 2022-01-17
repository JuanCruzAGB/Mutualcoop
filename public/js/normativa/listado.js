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

    let paragraph;
    if (document.querySelector('.not-found')) {
        paragraph = document.querySelector('.not-found');
        paragraph.innerHTML = 'No se encontraron resultados';
    } else {
        paragraph = document.createElement('p');
        paragraph.innerHTML = 'No se encontraron resultados';
        paragraph.classList.add('not-found', 'text-gray-600');
        parent.appendChild(paragraph);
    }
}

document.addEventListener('DOMContentLoaded', function(e){
    if(normativas.length){
        let list = new List({
            data: [],
        }, document.querySelector('#normativas .lista-data'));

        let filtros = new Filter({
            id: 'normativas',
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
            target: 'id_tipo_normativa',
        }, {
            type: 'checkbox',
            target: 'temas',
        }, {
            type: 'checkbox',
            target: 'obras',
        }], normativas);

        let newNormativa = filtros.execute();
        list.changeData(newNormativa);
        let nextBtn = document.querySelector('.filter-next');
        for (const normativa of newNormativa) {
            nextBtn.href = `#normativa-${normativa.id_normativa}`;
        }

        document.querySelector('.filter-next').addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = this.href;
            let next = filtros.next();
            if(next){
                list.addRows(next.data);
                console.log('#' + this.href.split('#')[1]);
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
    }else{
        console.error('No se encontraron Normativas para mostrar.');
    }
});