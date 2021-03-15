// * External repositories
import { Sidebar } from '/submodules/SidebarJS/js/Sidebar.js';
import { TabMenu } from '/submodules/TabMenuJS/js/TabMenu.js';

import { LocalStorageServiceProvider } from '../../Providers/LocalStorageServiceProvider.js';

// * Local Repository
import { AdministradorSection } from './administrador.js';
// import { SuscriptorSection } from './suscriptor.js';

let sections = {
    gestiones: {
        filtros: undefined,
        tablas: undefined
    }, normativas: {
        filtros: undefined,
        tablas: undefined
    }, educaciones: {
        filtros: undefined,
        tablas: undefined
    }
}

if(usuario.id_nivel > 1){
    sections.tabla_categorias = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_educaciones = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_eventos = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_facturaciones = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_gestiones = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_normativas = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_noticias = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_precios = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_suscriptores = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_temas = {
        filtros: undefined,
        tablas: undefined
    }
    sections.tabla_usuarios = {
        filtros: undefined,
        tablas: undefined
    }
}

let filters = {
    filtrar_por_obras: document.querySelector(`.filtrar_por_obras`),
    mes: document.querySelector(`.mes`),
    nivel: document.querySelector(`.nivel`),
    organismo: document.querySelector(`.organismo`),
    privado: document.querySelector(`.privado`),
    sin_filtros: document.querySelector(`.sin_filtros`),
    tipo_de_gestion: document.querySelector(`.tipo_de_gestion`),
    tipo_de_normativa: document.querySelector(`.tipo_de_normativa`),
    tipo_de_suscripcion: document.querySelector(`.tipo_de_suscripcion`),
};

// async function fillSuscriptorData(LocalStorageInstance){
//     let data = {
//         educaciones: await getData('/api/educaciones', LocalStorageInstance),
//         gestiones: await getData('/api/gestiones', LocalStorageInstance),
//         normativas: await getData('/api/normativas', LocalStorageInstance),
//     };

// // * Cargamos los datos de las secciones
//     fillSections(data);
// }

function showFilter(filtersToShow){
    for(const key in filters){
        if(filters.hasOwnProperty(key)){
            const filter = filters[key];
            filter.style.display = 'none';
        }
    }
    
    for(const filter of filtersToShow){
        filters[filter].style.display = 'block';
    }
}

function createTotalValue(data){
    if(data && data.length){
        let empty = document.createElement('tr');
        empty.classList.add('empty');
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        empty.appendChild(document.createElement('td'));
        sections.tabla_facturaciones.tabla.appendTr(empty);
            let td = document.createElement('td');
            empty.appendChild(td);
            td.classList.add('total', 'px-4', 'py-2');
                let span = document.createElement('span');
                td.appendChild(span);
                let value = 0;
                for(const usuario of data){
                    value += usuario.valor_original;
                }
                span.innerHTML = '$' + value;
        empty.appendChild(document.createElement('td'));
    }
}

function showSection(sectionToShow, reset = false){
    for(const key in sections){
        if(sections.hasOwnProperty(key)){
            const section = sections[key];
            section.content.close();
        }
    }

    sections[sectionToShow].content.open();

    sections[sectionToShow].filtros.reset();
    let data = sections[sectionToShow].filtros.execute();

    sections[sectionToShow].tabla.changeData(data);

    if(sectionToShow == 'tabla_facturaciones'){
        document.querySelector(`[data-name="id_tipo_suscripcion-debito"]`).style.display = 'none';
        createTotalValue(data, sections[sectionToShow]); 
    }else if(sectionToShow == 'tabla_suscriptores'){
        document.querySelector(`[data-name="id_tipo_suscripcion-debito"]`).style.display = 'block';
    }
}

// function changeSelectValue(value, seccion){
//     let select = document.querySelector(`select.filter[data-target]`);
//     let optSelected;
//     for(const option of select.children){
//         option.selected = false;
//         if(option.value == value){
//             optSelected = option;
//         }
//     }
//     if(optSelected){
//         optSelected.selected = true;
//         changeButtonValue();
//         seccion.filtros.changeValue(select.dataset.name, select.value);
//         let data = seccion.filtros.execute();
//         seccion.tabla.changeData(data);
//         createTotalValue(data, seccion);
//     }
// }

// function changeButtonValue(){
//     let buttons = document.querySelectorAll(`.fecha`);
//     let select = document.querySelector(`select.filter[data-target="alta"]`);
//     for(const btn of buttons){
//         if(btn.classList.contains('left')){
//             if(parseInt(select.value.split('(-').pop().split('-)').shift()) > 1){
//                 let number = (parseInt(select.value.split('(-').pop().split('-)').shift()) - 1);
//                 if(number < 10){
//                     number = '0' + number;
//                 }
//                 btn.value = '(-' + number + '-)';
//             }else{
//                 btn.value = '(-12-)';
//             }
//         }else{
//             if(parseInt(select.value.split('(-').pop().split('-)').shift()) < 12){
//                 let number = (parseInt(select.value.split('(-').pop().split('-)').shift()) + 1);
//                 if(number < 10){
//                     number = '0' + number;
//                 }
//                 btn.value = '(-' + number + '-)';
//             }else{
//                 btn.value = '(-01-)';
//             }
//         }
//     }
// }

// async function getData(URL, LocalStorageInstance, seccion){
//     let headers = {
//         "Content-Type": "application/json",
//         'Authorization': `Bearer ${JSON.parse(LocalStorageInstance.data)}`,
//     }
//     let FetchInstance = await FetchServiceProvider.getData(URL, headers);
//     let data = FetchInstance.getResponse('data');
//     switch(seccion.id){
//         case 'usuarios':
//             seccion.filtros.changeData(data.usuarios);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             document.querySelector('[data-name=id_nivel-todos] span:last-of-type').innerHTML = data.total;
//             document.querySelector('[data-name=id_nivel-suscriptor] span:last-of-type').innerHTML = data.suscriptores;
//             document.querySelector('[data-name=id_nivel-administrador] span:last-of-type').innerHTML = data.administradores;
//             break;
//         case 'categorias':
//             seccion.filtros.changeData(data.categorias);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             break;
//         case 'temas':
//             seccion.filtros.changeData(data.temas);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             document.querySelector('[data-name=id_organismo-todos] span:last-of-type').innerHTML = data.total;
//             document.querySelector('[data-name=id_organismo-inaes] span:last-of-type').innerHTML = data.inaes;
//             document.querySelector('[data-name=id_organismo-otros_organismos] span:last-of-type').innerHTML = data.otros_organismos;
//             break;
//         case 'eventos':
//             seccion.filtros.changeData(data.eventos);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             break;
//         case 'precios':
//             seccion.tabla.changeData(data.precios);
//             break;
//         case 'noticias':
//             seccion.tabla.changeData(data.noticias);
//             break;
//         case 'educaciones':
//             seccion.tabla.changeData(data.educaciones);
//             break;
//         case 'gestiones':
//             seccion.filtros.changeData(data.gestiones);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             document.querySelector('[data-name=id_tipo_gestion-todos] span:last-of-type').innerHTML = data.total;
//             document.querySelector('[data-name=id_tipo_gestion-administrativo_contable] span:last-of-type').innerHTML = data.administrativo_contable;
//             document.querySelector('[data-name=id_tipo_gestion-impositivo] span:last-of-type').innerHTML = data.impositivo;
//             document.querySelector('[data-name=id_tipo_gestion-previsional] span:last-of-type').innerHTML = data.previsional;
//             document.querySelector('[data-name=id_tipo_gestion-recursos] span:last-of-type').innerHTML = data.recursos;
//             document.querySelector('[data-name=id_tipo_gestion-analisis_reglamentacion] span:last-of-type').innerHTML = data.analisis_reglamentacion;
//             document.querySelector('[data-name=id_tipo_gestion-informacion_complementaria] span:last-of-type').innerHTML = data.informacion_complementaria;
//             document.querySelector('[data-name=id_tipo_gestion-jurisprudencia] span:last-of-type').innerHTML = data.jurisprudencia;
//             break;
//         case 'normativas':
//             seccion.filtros.changeData(data.normativas);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             document.querySelector('[data-name=id_tipo_normativa-todos] span:last-of-type').innerHTML = data.total;
//             document.querySelector('[data-name=id_tipo_normativa-ley] span:last-of-type').innerHTML = data.ley;
//             document.querySelector('[data-name=id_tipo_normativa-decreto] span:last-of-type').innerHTML = data.decreto;
//             document.querySelector('[data-name=id_tipo_normativa-resolucion] span:last-of-type').innerHTML = data.resolucion;
//             break;
//         case 'suscriptores':
//             seccion.filtros.changeData(data.usuarios);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             document.querySelector('[data-name=id_tipo_suscripcion-todos] span:last-of-type').innerHTML = data.total;
//             document.querySelector('[data-name=id_tipo_suscripcion-debito] span:last-of-type').innerHTML = data.debito;
//             document.querySelector('[data-name=id_tipo_suscripcion-semestral] span:last-of-type').innerHTML = data.semestral;
//             document.querySelector('[data-name=id_tipo_suscripcion-anual] span:last-of-type').innerHTML = data.anual;
//             break;
//         case 'facturaciones':
//             seccion.filtros.changeData(data.usuarios);
//             seccion.tabla.changeData(seccion.filtros.execute());
//             break;
//     }
// }

async function load(){
    let sidebar_tab = new Sidebar({
        id: 'tab',
        position: 'left',
    }, {
        open: false,
    });

    let sidebar_filters = new Sidebar({
        id: 'filters',
        position: 'right',
    }, {
        open: false,
    });

    let tabmenu = new TabMenu({
        id: 'tab-1',
    }, {
        open: (window.location.href.split('#').pop()) ? [window.location.href.split('#').pop()] : false,
    });

// * Guardamos el Tab Content de cada sección
    for(const content of tabmenu.contents){
        for(const id in sections){
            if(sections.hasOwnProperty(id)){
                const section = sections[id];
                if(content.properties.id == id){
                    section.content = content;
                }
            }
        }
    }

    for(const tab of tabmenu.tabs){
        for(const id in sections){
            if(sections.hasOwnProperty(id)){
                const section = sections[id];
                if(tab.properties.id == id){
                    section.tab = tab;
                }
            }
        }
    }
    
// * Creación de las acciones de los Filtros
    let obrasCheckboxes = document.querySelectorAll(`.filter[data-target='obras']`);
    for(const html of obrasCheckboxes){
        html.addEventListener('change', function(e){
            e.preventDefault();
            // seccion_gestiones.tabla.changeData(seccion_gestiones.filtros.execute());
            // seccion_normativas.tabla.changeData(seccion_normativas.filtros.execute());
            // seccion_facturaciones.tabla.changeData(seccion_facturaciones.filtros.execute());
            // seccion_suscriptores.tabla.changeData(seccion_suscriptores.filtros.execute());
            // seccion_normativas_suscriptor.tabla.changeData(seccion_normativas_suscriptor.filtros.execute());
            // seccion_gestiones_suscriptor.tabla.changeData(seccion_gestiones_suscriptor.filtros.execute());
            // seccion_temas.tabla.changeData(seccion_temas.filtros.execute());
            // seccion_categorias.tabla.changeData(seccion_categorias.filtros.execute());
        });
    }
    
    let idTipoGestionInputs = document.querySelectorAll(`.filter[data-target='id_tipo_gestion']`);
    for(const html of idTipoGestionInputs){
        html.addEventListener('click', function(e){
            e.preventDefault();
            // seccion_gestiones.tabla.changeData(seccion_gestiones.filtros.execute());
            // seccion_categorias.tabla.changeData(seccion_categorias.filtros.execute());
        });
    }
    
    let idTipoNormativaInputs = document.querySelectorAll(`.filter[data-target='id_tipo_normativa']`);
    for(const html of idTipoNormativaInputs){
        html.addEventListener('click', function(e){
            e.preventDefault();
            // seccion_normativas.tabla.changeData(seccion_normativas.filtros.execute());
        });
    }
    
    let idTipoSuscripcionInputs = document.querySelectorAll(`.filter[data-target='id_tipo_suscripcion']`);
    for(const html of idTipoSuscripcionInputs){
        html.addEventListener('click', function(e){
            e.preventDefault();
            // seccion_facturaciones.tabla.changeData(seccion_facturaciones.filtros.execute());
            // seccion_suscriptores.tabla.changeData(seccion_suscriptores.filtros.execute());
        });
    }

    let idNivelInputs = document.querySelectorAll(`.filter[data-target='id_nivel']`);
    for(const html of idNivelInputs){
        html.addEventListener('click', function(e){
            e.preventDefault();
            // seccion_usuarios.tabla.changeData(seccion_usuarios.filtros.execute());
        });
    }

    let idOrganismoInputs = document.querySelectorAll(`.filter[data-target='id_organismo']`);
    for(const html of idOrganismoInputs){
        html.addEventListener('click', function(e){
            e.preventDefault();
            // seccion_temas.tabla.changeData(seccion_temas.filtros.execute());
        });
    }

    let fechaArrowButtons = document.querySelectorAll(`.fecha`);
    for(const html of fechaArrowButtons){
        html.addEventListener('click', function(e){
            e.preventDefault();
            // changeSelectValue(this.value, seccion_facturaciones);
        });
    }
    
    let fechaSelects = document.querySelectorAll(`.filter[data-target="alta"]`);
    for(const html of fechaSelects){
        html.addEventListener('change', function(e){
            // changeButtonValue();
            // let data = seccion_facturaciones.filtros.execute();
            // seccion_facturaciones.tabla.changeData(data);
            // createTotalValue(data, seccion_facturaciones);
        });
    }

    // let cargarMasBtns = document.querySelectorAll(`.agregar-10`);
    // for(const btn of cargarMasBtns){
    //     btn.addEventListener('click', function(e){
    //         e.preventDefault();
    //         let newData;
    //         switch(this.href.split('#').pop()){
    //             case 'normativas-suscriptor':
    //                 if(newData = seccion_normativas_suscriptor.filtros.next()){
    //                     seccion_normativas_suscriptor.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'gestiones-suscriptor':
    //                 if(newData = seccion_gestiones_suscriptor.filtros.next()){
    //                     seccion_gestiones_suscriptor.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'suscriptores':
    //                 if(newData = seccion_suscriptores.filtros.next()){
    //                     seccion_suscriptores.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'facturaciones':
    //                 if(newData = seccion_facturaciones.filtros.next()){
    //                     seccion_facturaciones.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'eventos':
    //                 if(newData = seccion_eventos.filtros.next()){
    //                     seccion_eventos.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'temas':
    //                 seccion_temas.filtros.next();
    //                 if(newData = seccion_temas.filtros.next()){
    //                     seccion_temas.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'categorias':
    //                 seccion_categorias.filtros.next();
    //                 if(newData = seccion_categorias.filtros.next()){
    //                     seccion_categorias.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'gestiones':
    //                 seccion_gestiones.filtros.next();
    //                 if(newData = seccion_gestiones.filtros.next()){
    //                     seccion_gestiones.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'normativas':
    //                 if(newData = seccion_normativas.filtros.next()){
    //                     seccion_normativas.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'usuarios':
    //                 if(newData = seccion_usuarios.filtros.next()){
    //                     seccion_usuarios.tabla.addRows(newData);
    //                 }
    //                 break;
    //         }
    //     });
    // }

    // let reOrderBtns = document.querySelectorAll(`.filter-order`);
    // for(const btn of reOrderBtns){
    //     btn.addEventListener('click', function(e){
    //         e.preventDefault();
    //         let order = {
    //             by: this.dataset.by,
    //             type: this.dataset.type,
    //         };
    //         switch(order.type.toUpperCase()){
    //             case 'DESC':
    //                 this.dataset.type = 'ASC';
    //                 break;
    //             case 'ASC':
    //                 this.dataset.type = 'DESC';
    //                 break;
    //         }
    //         if(this.children.length){
    //             let icon = this.children[0];
    //             if(icon.classList.contains('fa-sort-down')){
    //                 icon.classList.remove('fa-sort-down');
    //                 icon.classList.add('fa-sort-up');
    //             }else{
    //                 icon.classList.remove('fa-sort-up');
    //                 icon.classList.add('fa-sort-down');
    //             }
    //         }else{
    //             let icon = document.createElement('i');
    //             icon.classList.add('order-icon', 'fas', 'fa-sort-down', 'ml-3', 'flex', 'items-center');
    //             this.appendChild(icon);
    //         }
    //         switch(this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.id){
    //             case 'normativas':
    //                 if(newData = seccion_normativas_suscriptor.filtros.next()){
    //                     seccion_normativas_suscriptor.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'gestiones':
    //                 if(newData = seccion_gestiones_suscriptor.filtros.next()){
    //                     seccion_gestiones_suscriptor.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'temas':
    //                 if(newData = seccion_temas_suscriptor.filtros.next()){
    //                     seccion_temas_suscriptor.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'categorias':
    //                 if(newData = seccion_categorias_suscriptor.filtros.next()){
    //                     seccion_categorias_suscriptor.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'tabla_suscriptores':
    //                 if(newData = seccion_suscriptores.filtros.next()){
    //                     seccion_suscriptores.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'tabla_facturaciones':
    //                 if(newData = seccion_facturaciones.filtros.next()){
    //                     seccion_facturaciones.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'tabla_eventos':
    //                 if(newData = seccion_eventos.filtros.next()){
    //                     seccion_eventos.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'tabla_gestiones':
    //                 seccion_gestiones.filtros.next();
    //                 if(newData = seccion_gestiones.filtros.next()){
    //                     seccion_gestiones.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'tabla_normativas':
    //                 if(newData = seccion_normativas.filtros.next()){
    //                     seccion_normativas.tabla.addRows(newData);
    //                 }
    //                 break;
    //             case 'tabla_usuarios':
    //                 seccion_usuarios.filtros.changeOrder(order);
    //                 seccion_usuarios.tabla.changeData(seccion_usuarios.filtros.execute());
    //                 break;
    //         }
    //     });
    // }

    // changeButtonValue();

    // document.querySelectorAll('.sub-seccion-button')[0].addEventListener('click', function(e){
    //     showFilter(['organismo', 'filtrar-por-obras'], seccion_temas, true);
    //     for(const content of tabmenu.contents){
    //         if(content.checkId('temas')){
    //             content.open();
    //         }else{
    //             content.close();
    //         }
    //     }
    // });

    // document.querySelectorAll('.sub-seccion-button')[0].addEventListener('click', function(e){
    //     showFilter(['tipo-de-gestion', 'filtrar-por-obras'], seccion_categorias, true);
    //     for(const content of tabmenu.contents){
    //         if(content.checkId('categorias')){
    //             console.log(content);
    //             content.open();
    //         }else{
    //             content.close();
    //         }
    //     }
    // });

// * Traemos los datos por la api
    let LocalStorageInstance = LocalStorageServiceProvider.getData('mutualcoop_token');

    if(LocalStorageInstance.checkData()){
        if(usuario.id_nivel > 1){
            await AdministradorSection(sections, LocalStorageInstance);
        }
        // SuscriptorSection(sections, LocalStorageInstance);

// * Cargamos la seccion abierta por defecto
        switch(window.location.href.split('#').pop()){
            case 'tabla_categorias':
                showFilter(['tipo-de-gestion', 'filtrar-por-obras']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_educaciones':
                showFilter(['sin-filtros']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_eventos':
                showFilter(['privado']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_facturaciones':
                showFilter(['tipo-de-suscripcion', 'mes', 'filtrar-por-obras']);
                showSection(window.location.href.split('#').pop());
                changeButtonValue();
                break;
            case 'tabla_gestiones':
                showFilter(['tipo-de-gestion', 'filtrar-por-obras']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_normativas':
                showFilter(['tipo-de-normativa', 'filtrar-por-obras']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_noticias':
                showFilter(['sin-filtros']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_precios':
                showFilter(['sin-filtros']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_suscriptores':
                showFilter(['tipo-de-suscripcion', 'filtrar-por-obras']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_temas':
                showFilter(['organismo', 'filtrar-por-obras']);
                showSection(window.location.href.split('#').pop());
                break;
            case 'tabla_usuarios':
                showFilter(['nivel']);
                showSection(window.location.href.split('#').pop());
                break;
        }
        
// * Establecemos las acciones de los Tab
        for(const position in tabmenu.tabs){
            if(tabmenu.tabs.hasOwnProperty(position)){
                const tab = tabmenu.tabs[position];
                switch(tab.target){
                    case 'tabla_eventos':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['privado']);
                            showSection(tab.target);
                        });
                        break;
                    case 'tabla_gestiones':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['tipo-de-gestion', 'filtrar-por-obras']);
                            showSection(tab.target);
                        });
                        break;
                    case 'tabla_normativas':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['tipo-de-normativa', 'filtrar-por-obras']);
                            showSection(tab.target);
                        });
                        break;
                    case 'tabla_educaciones':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['sin-filtros']);
                            showSection(tab.target);
                        });
                        break;
                    case 'tabla_noticias':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['sin-filtros']);
                            showSection(tab.target);
                        });
                        break;
                    case 'tabla_precios':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['sin-filtros']);
                            showSection(tab.target);
                        });
                        break;
                    case 'tabla_usuarios':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['nivel']);
                            showSection(tab.target);
                        });
                        break;
                    case 'tabla_facturaciones':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['tipo-de-suscripcion', 'mes', 'filtrar-por-obras']);
                            showSection(tab.target);
                            changeButtonValue();
                        });
                        break;
                    case 'tabla_suscriptores':
                        tab.html.addEventListener('click', function(e){
                            showFilter(['tipo-de-suscripcion', 'filtrar-por-obras']);
                            showSection(tab.target);
                        });
                        break;
                }
            }
        }
    }else{
// * Redireccionamos en caso de que no esté el token guardado
        window.location.href = "/ingresar";
    }
}

document.addEventListener('DOMContentLoaded', load);