import { Table } from '../../../../Table/Table.js';

let normativas_tabla = new Table({
    html: document.querySelector('.tab-content-list #normativas table'),
    cols: [
        {title: 'Título', data: 'titulo',},
        {title: '', data: '', actions: ['file','more','edit','delete']},
    ],
    data: normativas.total.normativas,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});

if(window.location.href.split('#').length > 1){
    switch(window.location.href.split('#').pop()){
        case 'ley':
                if(normativas.ley.normativas.length){
                    normativas_tabla.changeData(normativas.ley.normativas);
                }else{
                    normativas_tabla.changeData();
                }
            break;
        case 'decreto':
                if(normativas.decreto.normativas.length){
                    normativas_tabla.changeData(normativas.decreto.normativas);
                }else{
                    normativas_tabla.changeData();
                }
            break;
        case 'resolucion':
                if(normativas.resolucion.normativas.length){
                    normativas_tabla.changeData(normativas.resolucion.normativas);
                }else{
                    normativas_tabla.changeData();
                }
            break;
    }
}

export let multiple_normativas = normativas_tabla;