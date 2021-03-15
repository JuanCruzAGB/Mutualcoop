import { Table } from '../../../../Table/Table.js';

let gestiones_tabla = new Table({
    html: document.querySelector('.tab-content-list #gestiones table'),
    cols: [
        {title: 'Título', data: 'titulo',},
        {title: '', data: '', actions: ['file','more','edit','delete']},
    ],
    data: gestiones.total.gestiones,
}, {
    thead: ['bg-blue-900','text-white',],
    td: ['border','px-4','py-2',],
    th: ['px-4','py-2',],
});

if(window.location.href.split('#').length > 1){
    switch(window.location.href.split('#').pop()){
        case 'administrativo-contable':
                if(gestiones.administrativo_contable.gestiones.length){
                    gestiones_tabla.changeData(gestiones.administrativo_contable.gestiones);
                }else{
                    gestiones_tabla.changeData([]);
                }
            break;
        case 'impositivo':
                if(gestiones.impositivo.gestiones.length){
                    gestiones_tabla.changeData(gestiones.impositivo.gestiones);
                }else{
                    gestiones_tabla.changeData([]);
                }
            break;
        case 'previsional':
                if(gestiones.previsional.gestiones.length){
                    gestiones_tabla.changeData(gestiones.previsional.gestiones);
                }else{
                    gestiones_tabla.changeData([]);
                }
            break;
        case 'recursos':
                if(gestiones.recursos.gestiones.length){
                    gestiones_tabla.changeData(gestiones.recursos.gestiones);
                }else{
                    gestiones_tabla.changeData([]);
                }
            break;
        case 'analisis-de-la-reglamentacion':
                if(gestiones.analisis_reglamentacion.gestiones.length){
                    gestiones_tabla.changeData(gestiones.analisis_reglamentacion.gestiones);
                }else{
                    gestiones_tabla.changeData([]);
                }
            break;
        case 'informacion-coplementaria':
                if(gestiones.informacion_coplementaria.gestiones.length){
                    gestiones_tabla.changeData(gestiones.informacion_coplementaria.gestiones);
                }else{
                    gestiones_tabla.changeData([]);
                }
            break;
        case 'jurisprudencia':
                if(gestiones.jurisprudencia.gestiones.length){
                    gestiones_tabla.changeData(gestiones.jurisprudencia.gestiones);
                }else{
                    gestiones_tabla.changeData([]);
                }
            break;
    }
}

export let  multiple_gestiones = gestiones_tabla;