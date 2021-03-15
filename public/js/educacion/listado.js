import { List } from "../List/List.js";
import { Filter } from "../../submodules/FilterJS/js/Filter.js";

function changeTableContent(params = undefined){
    params.list.changeData(params.data);
}

document.addEventListener('DOMContentLoaded', function(e){
    if(educaciones.length){
        let lista = new List({
            data: [],
        }, document.querySelector('#educaciones .lista-data'));

        let filtros = new Filter({
            id: 'educaciones',
            order: {
                by: 'updated_at',
            },
            event: {
                function: changeTableContent,
                params: {
                    list: list,
                },
            },
        }, {}, [{
            type: 'search',
            target: 'titulo',
        }], educaciones);

        list.changeData(filtros.execute());
    }else{
        console.error('No se encontraron Notas de Interés para mostrar.');
    }
});