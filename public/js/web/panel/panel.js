// * External repositories
import { Sidebar } from '/submodules/SidebarJS/js/Sidebar.js';
import { TabMenu } from '/submodules/TabMenuJS/js/TabMenu.js';
import { Notification } from '/submodules/NotificationJS/js/Notification.js';

import { Filter } from '../../../submodules/FilterJS/js/Filter.js';
import { LocalStorageServiceProvider } from '../../Providers/LocalStorageServiceProvider.js';
import { LoadProgressBar } from '../../loaders.js';
import { URL } from '../../URL.js';

// * Local Repository
import { getData } from "./getData.js";
import { Table } from '../../Table/Table.js';
import { showDetalles, showSection, sections, filters } from "./showData.js";

let clases = {
    thead: ['background', 'background-uno', 'text-white', ],
    td: ['border', 'px-4', 'py-2', ],
    th: ['px-4', 'py-2', ],
};

async function getSuscriptorData(url_sections, tabmenu, LocalStorageInstance, show){
    for(const loader of document.querySelectorAll('.loader')){
        if(loader.classList.contains('closed')){
            loader.classList.toggle('opened');
            loader.classList.toggle('closed');
        }
    }
    let current = 0,
        length = 0;
    for(const section of url_sections){
        length++;
    }
    for(const section of url_sections){
        LoadProgressBar(`Cargando sección: ${current} / ${length}`, current, length);
        const urls = section.url;
        let data = [];
        if(typeof urls == 'object'){
            for(const element of urls){
                data.push({id: element.id, data: await getData(element.url, LocalStorageInstance)});
            }
        }else{
            data = await getData(urls, LocalStorageInstance);
        }
        loadSection(section.id, tabmenu, data, show);
        current++;
        LoadProgressBar(`Cargando sección: ${current}/${length}`, current, length);
    }
}

async function getAdministradorData(url_sections, tabmenu, LocalStorageInstance, show){
    for(const loader of document.querySelectorAll('.loader')){
        if(loader.classList.contains('closed')){
            loader.classList.toggle('opened');
            loader.classList.toggle('closed');
        }
    }
    let current = 0,
        length = 0;
    for(const section of url_sections){
        length++;
    }
    for(const section of url_sections){
        LoadProgressBar(`Cargando sección del administrador: ${current} / ${length}`, current, length);
        const url = section.url;
        loadSection(section.id, tabmenu, await getData(url, LocalStorageInstance));
        current++;
        LoadProgressBar(`Cargando sección del administrador: ${current}/${length}`, current, length);
    }
    for(const btn of document.querySelectorAll('.sub-seccion-button')){
        btn.parentNode.classList.toggle('hidden');
    }
}

function setImportedData(show, tabmenu){
    for(const menu of document.querySelectorAll('.floating-menu')){
        menu.classList.toggle('hidden');
    }
    for(const btn of document.querySelectorAll('.filter-next')){
        btn.parentNode.classList.toggle('hidden');
    }
    switch(show){
        case 'tabla_categorias':
            showSection(sections.tabla_categorias);
            break;
        case 'tabla_educaciones':
            showSection(sections.tabla_educaciones);
            break;
        case 'tabla_eventos':
            showSection(sections.tabla_eventos);
            break;
        case 'tabla_facturaciones':
            showSection(sections.tabla_facturaciones);
            break;
        case 'tabla_gestiones':
            showSection(sections.tabla_gestiones);
            break;
        case 'tabla_normativas':
            showSection(sections.tabla_normativas);
            break;
        case 'tabla_noticias':
            showSection(sections.tabla_noticias);
            break;
        case 'tabla_precios':
            showSection(sections.tabla_precios);
            break;
        case 'tabla_suscriptores':
            showSection(sections.tabla_suscriptores);
            break;
        case 'tabla_temas':
            showSection(sections.tabla_temas);
            break;
        case 'tabla_usuarios':
            showSection(sections.tabla_usuarios);
            break;
        case 'ley':
            sections.normativas.current = 'ley';
            showSection(sections.normativas);
            break;
        case 'decreto':
            sections.normativas.current = 'decreto';
            showSection(sections.normativas);
            break;
        case 'resolucion':
            sections.normativas.current = 'resolucion';
            showSection(sections.normativas);
            break;
        case 'administrativo_contable':
            sections.gestiones.current = 'administrativo_contable';
            showSection(sections.gestiones);
            break;
        case 'impositivo':
            sections.gestiones.current = 'impositivo';
            showSection(sections.gestiones);
            break;
        case 'previsional':
            sections.gestiones.current = 'previsional';
            showSection(sections.gestiones);
            break;
        case 'recursos':
            sections.gestiones.current = 'recursos';
            showSection(sections.gestiones);
            break;
        case 'analisis_de_la_reglamentacion':
            sections.gestiones.current = 'analisis_reglamentacion';
            showSection(sections.gestiones);
            break;
        case 'informacion_complementaria':
            sections.gestiones.current = 'informacion_complementaria';
            showSection(sections.gestiones);
            break;
        case 'jurisprudencia':
            sections.gestiones.current = 'jurisprudencia';
            showSection(sections.gestiones);
            break;
        case 'educaciones':
            showSection(sections.educaciones);
            break;
        case 'detalles':
            showSection(sections.detalles);
            break;
    }
};

function getAData(section, data, id = null){
    if(!id){
        id = URL.findGetParameter('id');
    }
    for(const element of data){
        if(element[section.primaryKey] == id){
            return element;
        }
    }
}

function fillDetallesSection(section, tabmenu){
    if(URL.findGetParameter('section') && URL.findGetParameter('id')){
        const section = URL.findGetParameter('section');
        let actions = sections[section].actions;
        showDetalles(actions.more.details, {'{all}': getAData(sections[section], sections[section].data[sections[section].dataKey])});
    }
    section.filtrosClassName = ['sin_filtros'];
    for (const content of tabmenu.contents) {
        if (content.properties.id == 'detalles') {
            section.content = content;
        }
    }
}

function fillGestionesSection(section, current){
    let filteredData = [];
    if(section.subsections.hasOwnProperty(current)){
        section.current = current;
        for(const element of section.data){
            if(element.id == current){
                filteredData = element.data.gestiones;
            }
        }
    }
    section.filtrosClassName = ['filtrar_por_obras'];
    section.filtros = new Filter({
        id: 'gestiones',
        order: {
            by: 'id_gestion',
        }, limit: 10,
    }, {}, [{
        target: 'obras',
    }], filteredData);
    section.actions = {file: {
        data: 'archivo',
    }, more: {
        data: 'id_gestion',
        details: {
            section: 'gestiones',
            actions: {
                file: {
                    data: 'archivo',
            }}, sections: [{
                title: 'Tipo de Gestión',
                value: 'tipo:nombre'
            },{
                title: 'Categoría',
                value: 'categoria:nombre'
            },{
                title: 'Título',
                value: 'titulo'
            },{
                title: 'Copete',
                value: 'copete'
        }]},
    }};
    section.cols = [
        {title: 'Título', data: 'titulo',},
        {title: '', data: '{all},id_gestion,archivo', actions: section.actions},
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #gestiones table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            sections.gestiones.current = this.href.split('#').pop();
            showSection(section);
        });
    }
}

function fillNormativasSection(section, current){
    let filteredData = [];
    if(section.subsections.hasOwnProperty(current)){
        section.current = current;
        for(const element of section.data){
            if(element.id == current){
                filteredData = element.data.normativas;
            }
        }
    }
    section.filtrosClassName = ['filtrar_por_obras'];
    section.current = current;
    section.actions = {
        file: {
            data: 'archivo',
        }, more: {
            data: 'id_normativa',
            details: {
                section: 'normativas',
                actions: {
                    file: {
                        data: 'archivo',
                }}, sections: [{
                    title: 'Tipo de Normativa',
                    value: 'tipo:nombre'
                },{
                    title: 'Temas',
                    value: 'temas:nombre'
                },{
                    title: 'Título',
                    value: 'titulo'
                },{
                    title: 'Copete',
                    value: 'copete'
                },{
                    title: 'Obras',
                    value: 'obras:nombre'
        }]},
    }};
    section.filtros = new Filter({
        id: 'normativas',
        order: {
            by: 'id_normativa',
        }, limit: 10,
    }, {}, [{
        target: 'obras',
    }], filteredData);
    section.cols = [
        {title: 'Título', data: 'titulo',},
        {title: '', data: '{all},id_normativa,archivo', actions: section.actions},
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #normativas table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            sections.normativas.current = this.href.split('#').pop();
            showSection(section);
        });
    }
}

function fillEducacionesSection(section){
    section.filtrosClassName = ['sin_filtros'];
    section.actions = {
        file: {
            data: 'archivo',
        }, more: {
            data: 'id_educacion',
            details: {
                section: 'educaciones',
                actions: {
                    file: {
                        data: 'archivo',
                }}, sections: [{
                    title: 'Título',
                    value: 'titulo'
                },{
                    title: 'Copete',
                    value: 'copete'
        }]},
    }};
    section.cols = [
        {title: 'Título', data: 'titulo',},
        {title: '', data: '{all},id_educacion,archivo', actions: section.actions},
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #educaciones table'),
        cols: section.cols,
        data: section.data.educaciones,
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaCategoriasSection(section){
    section.filtrosClassName = ['tipo_de_gestion', 'filtrar_por_obras'];
    section.filtros =  new Filter({
        id: 'tabla_categorias',
        order: {
            by: 'id_categoria',
        },
        limit: 10,
    }, {}, [{
        target: 'id_tipo_gestion',
    }, {
        target: 'obras',
    }], section.data.categorias);
    section.actions = {
        edit: {
            data: 'slug',
            url: '/panel/categoria'
        },
        delete: {
            data: 'id_categoria',
            url: '/categoria'
        }
    };
    section.cols = [
        { title: 'Nombre', data: 'nombre', },
        { title: 'Tipo de Gestión', data: 'tipo', },
        {
            title: '',
            data: 'id_categoria,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_categorias table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
}

function fillTablaEducacionesSection(section){
    section.filtrosClassName = ['sin_filtros'];
    section.actions = {
        file: {
            data: 'archivo',
        },
        more: {
            data: 'id_educacion',
            details: {
                section: 'tabla_educaciones',
                actions: {
                    file: {
                        data: 'archivo',
                    }, edit: {
                        data: 'slug',
                        url: '/panel/educacion'
                    }, delete: {
                        data: 'id_educacion',
                        url: '/educacion'
                }}, sections: [{
                    title: 'Título',
                    value: 'titulo'
                },{
                    title: 'Copete',
                    value: 'copete'
        }]},
        },
        edit: {
            data: 'slug',
            url: '/panel/educacion'
        },
        delete: {
            data: 'id_educacion',
            url: '/educacion'
        }
    };
    section.cols = [
        { title: 'Título', data: 'titulo', },
        {
            title: '',
            data: '{all},id_educacion,archivo,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_educaciones table'),
        cols: section.cols,
        data: section.data.educaciones,
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaEventosSection(section){
    section.filtrosClassName = ['privado'];
    section.filtros = new Filter({
        id: 'tabla_eventos',
        order: {
            by: 'fecha',
        },
        limit: 10,
    }, {}, [], section.data.eventos);
    section.actions = {
        file: {
            data: 'archivo',
        },
        more: {
            data: 'id_evento',
            details: {
                section: 'tabla_eventos',
                actions: {
                    file: {
                        data: 'archivo',
                    }, edit: {
                        data: 'slug',
                        url: '/panel/evento'
                    }, delete: {
                        data: 'id_evento',
                        url: '/evento'
                }}, sections: [{
                    title: 'Título',
                    value: 'titulo'
                },{
                    title: 'Descripción',
                    value: 'descripcion'
                },{
                    title: 'Fecha',
                    value: 'fecha'
                },{
                    title: 'Organizador',
                    value: 'organizador'
                },{
                    title: 'Video',
                    value: 'video'
                },{
                    title: 'URL de Inscripción',
                    value: 'url_inscripcion'
                },{
                    title: 'Detalles',
                    value: 'detalles'
        }]},
        },
        edit: {
            data: 'slug',
            url: '/panel/evento'
        },
        delete: {
            data: 'id_evento',
            url: '/evento'
        }
    };
    section.cols = [
        { title: '', data: 'privado', },
        { title: 'Título', data: 'titulo', },
        { title: 'Fecha', data: 'fecha', },
        {
            title: '',
            data: '{all},id_evento,archivo,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_eventos table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaFacturacionesSection(section){
    section.filtrosClassName = ['tipo_de_suscripcion', 'mes', 'filtrar_por_obras'];
    section.filtros = new Filter({
        id: 'tabla_facturaciones',
        order: {
            by: 'id_suscriptor',
        },
    }, {}, [{
        target: 'alta',
        value: document.querySelector(`select.filter[data-target="alta"]`).value,
    }, {
        target: 'id_tipo_suscripcion',
    }, {
        target: 'obras',
    }], section.data.usuarios);
    section.actions = {
        more: {
            data: 'id_usuario',
            details: {
                section: 'tabla_facturaciones',
                actions: {
                    edit: {
                        data: 'slug',
                        url: '/panel/usuario'
                    }, delete: {
                        data: 'id_usuario',
                        url: '/usuario'
                }}, sections: [{
                    title: 'Correo',
                    value: 'correo'
                },{
                    title: 'Correo de Facturación',
                    value: 'correo_facturacion'
                },{
                    title: 'Correo de Información',
                    value: 'correo_informacion'
                },{
                    title: 'Nombre',
                    value: 'nombre'
                },{
                    title: 'Tipo de Suscripción',
                    value: 'tipo:nombre'
                },{
                    title: 'Nivel',
                    value: 'nivel:nombre'
                },{
                    title: 'Provincia',
                    value: 'provincia'
                },{
                    title: 'Dirección',
                    value: 'direccion'
                },{
                    title: 'Localidad',
                    value: 'localidad'
                },{
                    title: 'CUIT / CUIL',
                    value: 'cuit_cuil'
                },{
                    title: 'CBU',
                    value: 'cbu'
                },{
                    title: 'Teléfono',
                    value: 'telefono'
                },{
                    title: 'WhatsApp',
                    value: 'whatsapp'
                },{
                    title: 'Estado',
                    value: 'tipo_estado:nombre'
                },{
                    title: 'Fecha de Alta',
                    value: 'alta'
                },{
                    title: 'Fecha de Baja',
                    value: 'baja'
                },{
                    title: 'Obras suscriptas',
                    value: 'obras:nombre'
                },{
                    title: 'Detalles',
                    value: 'detalles'
        }]},
        }
    };
    section.cols = [
        { title: 'Número de Suscriptor', data: 'id_suscriptor', },
        { title: 'Nombre', data: 'nombre', },
        { title: 'Entidad', data: 'entidad', },
        { title: 'Provincia', data: 'provincia', },
        { title: 'Valor', data: 'valor_original', },
        {
            title: '',
            data: '{all},slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_facturaciones table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    createTotalValue();
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaGestionesSection(section){
    section.filtrosClassName = ['tipo_de_gestion', 'filtrar_por_obras'];
    section.filtros = new Filter({
        id: 'tabla_gestiones',
        order: {
            by: 'id_gestion',
        },
        limit: 10,
    }, {}, [{
        target: 'id_tipo_gestion',
    }, {
        target: 'obras',
    }], section.data.gestiones);
    section.actions = {
        file: {
            data: 'archivo',
        },
        more: {
            data: 'id_gestion',
            details: {
                section: 'tabla_gestiones',
                actions: {
                    file: {
                        data: 'archivo',
                    }, edit: {
                        data: 'slug',
                        url: '/panel/gestion'
                    }, delete: {
                        data: 'id_gestion',
                        url: '/gestion'
                }}, sections: [{
                    title: 'Tipo de Gestión',
                    value: 'tipo:nombre'
                },{
                    title: 'Categoría',
                    value: 'categoria:nombre'
                },{
                    title: 'Título',
                    value: 'titulo'
                },{
                    title: 'Copete',
                    value: 'copete'
                },{
                    title: 'Obras',
                    value: 'obras:nombre'
        }]},
        },
        edit: {
            data: 'slug',
            url: '/panel/gestion'
        },
        delete: {
            data: 'id_gestion',
            url: '/gestion'
        }
    };
    section.cols = [
        { title: 'Título', data: 'titulo', },
        { title: 'Tipo de Gestión', data: 'tipo', },
        { title: 'Categoría', data: 'categoria', },
        {
            title: '',
            data: '{all},id_gestion,archivo,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_gestiones table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaNormativasSection(section){
    section.filtrosClassName = ['tipo_de_normativa', 'filtrar_por_obras'];
    section.filtros = new Filter({
        id: 'tabla_normativas',
        order: {
            by: 'id_normativa',
        },
        limit: 10,
    }, {}, [{
        target: 'id_tipo_normativa',
    }, {
        target: 'obras',
    }], section.data.normativas);
    section.actions = {
        file: {
            data: 'archivo',
        },
        more: {
            data: 'id_normativa',
            details: {
                section: 'tabla_normativas',
                actions: {
                    file: {
                        data: 'archivo',
                    }, edit: {
                        data: 'slug',
                        url: '/panel/normativa'
                    }, delete: {
                        data: 'id_normativa',
                        url: '/normativa'
                }}, sections: [{
                    title: 'Tipo de Normativa',
                    value: 'tipo:nombre'
                },{
                    title: 'Temas',
                    value: 'temas:nombre'
                },{
                    title: 'Título',
                    value: 'titulo'
                },{
                    title: 'Copete',
                    value: 'copete'
                },{
                    title: 'Obras',
                    value: 'obras:nombre'
        }]},
        }, edit: {
            data: 'slug',
            url: '/panel/normativa'
        },
        delete: {
            data: 'id_normativa',
            url: '/normativa'
        }
    };
    section.cols = [
        { title: 'Título', data: 'titulo', },
        { title: 'Tipo de Normativa', data: 'tipo', },
        {
            title: '',
            data: '{all},id_normativa,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_normativas table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaNoticiasSection(section){
    section.filtrosClassName = ['sin_filtros'];
    section.actions = {
        file: {
            data: 'archivo',
        },
        more: {
            data: 'id_noticia',
            details: {
                section: 'tabla_noticias',
                actions: {
                    file: {
                        data: 'archivo',
                    }, edit: {
                        data: 'slug',
                        url: '/panel/noticia'
                    }, delete: {
                        data: 'id_noticia',
                        url: '/noticia'
                }}, sections: [{
                    title: 'Título',
                    value: 'titulo'
                },{
                    title: 'Subtitulo',
                    value: 'subtitulo'
                },{
                    title: 'Descripción',
                    value: 'descripcion'
                },{
                    title: 'Fuente',
                    value: 'fuente'
        }]},
        },
        edit: {
            data: 'slug',
            url: '/panel/noticia'
        },
        delete: {
            data: 'id_noticia',
            url: '/noticia'
        }
    };
    section.cols =[
        { title: 'Título', data: 'titulo', },
        {
            title: '',
            data: '{all},id_noticia,archivo,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_noticias table'),
        cols: section.cols,
        data: section.data.noticias,
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaPreguntasSection(section){
    section.filtrosClassName = ['privado'];
    section.filtros = new Filter({
        id: 'tabla_preguntas',
        order: {
            by: 'id_pregunta',
        },
        limit: 10,
    }, {}, [], section.data.preguntas);
    section.actions = {
        edit: {
            data: 'slug',
            url: '/panel/pregunta'
        },
        delete: {
            data: 'id_pregunta',
            url: '/pregunta'
        }
    };
    section.cols = [
        { title: '', data: 'privado', },
        { title: 'Pregunta', data: 'pregunta', },
        { title: 'Respuesta', data: 'respuesta', },
        {
            title: '',
            data: 'id_pregunta,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_preguntas table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaPreciosSection(section){
    section.filtrosClassName = ['sin_filtros'];
    section.actions = {
        edit: {
            data: 'id_precio',
            url: '/panel/precio'
        }
    };
    section.cols = [
        { title: 'Obra', data: 'id_obra', },
        { title: 'Valor Anual', data: 'valor_anual', },
        { title: 'Valor Semestral', data: 'valor_semestral', },
        {
            title: '',
            data: 'id_precio',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_precios table'),
        cols: section.cols,
        data: section.data.precios,
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaSuscriptoresSection(section){
    section.filtrosClassName = ['tipo_de_suscripcion', 'filtrar_por_obras'];
    section.filtros = new Filter({
        id: 'tabla_suscriptores',
        order: {
            by: 'id_suscriptor',
        },
        limit: 10,
    }, {}, [{
        target: 'obras',
    }, {
        target: 'id_tipo_suscripcion',
    }], section.data.usuarios);
    section.actions = {
        more: {
            data: 'id_usuario',
            details: {
                section: 'tabla_suscriptores',
                actions: {
                    edit: {
                        data: 'slug',
                        url: '/panel/usuario'
                    }, delete: {
                        data: 'id_usuario',
                        url: '/usuario'
                }}, sections: [{
                    title: 'Correo',
                    value: 'correo'
                },{
                    title: 'Correo de Facturación',
                    value: 'correo_facturacion'
                },{
                    title: 'Correo de Información',
                    value: 'correo_informacion'
                },{
                    title: 'Nombre',
                    value: 'nombre'
                },{
                    title: 'Tipo de Suscripción',
                    value: 'tipo:nombre'
                },{
                    title: 'Nivel',
                    value: 'nivel:nombre'
                },{
                    title: 'Provincia',
                    value: 'provincia'
                },{
                    title: 'Dirección',
                    value: 'direccion'
                },{
                    title: 'Localidad',
                    value: 'localidad'
                },{
                    title: 'CUIT / CUIL',
                    value: 'cuit_cuil'
                },{
                    title: 'CBU',
                    value: 'cbu'
                },{
                    title: 'Teléfono',
                    value: 'telefono'
                },{
                    title: 'WhatsApp',
                    value: 'whatsapp'
                },{
                    title: 'Estado',
                    value: 'tipo_estado:nombre'
                },{
                    title: 'Fecha de Alta',
                    value: 'alta'
                },{
                    title: 'Fecha de Baja',
                    value: 'baja'
                },{
                    title: 'Obras suscriptas',
                    value: 'obras:nombre'
                },{
                    title: 'Detalles',
                    value: 'detalles'
        }]},
        }
    };
    section.cols = [
        { title: 'N° de Suscriptor', data: 'id_suscriptor', },
        { title: 'Nombre', data: 'nombre', },
        { title: 'Correo', data: 'correo', },
        { title: 'Entidad', data: 'entidad', },
        { title: 'Tipo de Suscripción', data: 'id_tipo_suscripcion', },
        { title: 'Obras Suscriptas', data: 'obras', },
        {
            title: '',
            data: '{all},slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_suscriptores table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillTablaTemasSection(section){
    section.filtrosClassName = ['organismo', 'filtrar_por_obras'];
    section.filtros = new Filter({
        id: 'tabla_temas',
        order: {
            by: 'id_tema',
        },
        limit: 10,
    }, {}, [{
        target: 'id_organismo',
    }, {
        target: 'obras',
    }], section.data.temas);
    section.actions = {
        edit: {
            data: 'slug',
            url: '/panel/tema'
        },
        delete: {
            data: 'id_tema',
            url: '/tema'
        }
    };
    section.cols = [
        { title: 'Nombre', data: 'nombre', },
        { title: 'Organismo', data: 'organismo', },
        {
            title: '',
            data: 'id_tema,slug',
            actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_temas table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
}

function fillTablaUsuariosSection(section){
    section.filtrosClassName = ['nivel'];
    section.filtros = new Filter({
        id: 'tabla_usuarios',
        order: {
            by: 'id_suscriptor',
        },
        limit: 10,
    }, {}, [{
        target: 'id_nivel',
    }], section.data.usuarios);
    section.actions = {
        more: { data: 'id_usuario', details: {
            section: 'tabla_usuarios', actions: {
                edit: {
                    data: 'slug',
                    url: '/panel/usuario'
                }, delete: {
                    data: 'id_usuario',
                    url: '/usuario'
            }}, sections: [{
                title: 'Correo',
                value: 'correo'
            },{
                title: 'Correo de Facturación',
                value: 'correo_facturacion'
            },{
                title: 'Correo de Información',
                value: 'correo_informacion'
            },{
                title: 'Nombre',
                value: 'nombre'
            },{
                title: 'Tipo de Suscripción',
                value: 'tipo:nombre'
            },{
                title: 'Nivel',
                value: 'nivel:nombre'
            },{
                title: 'Provincia',
                value: 'provincia'
            },{
                title: 'Dirección',
                value: 'direccion'
            },{
                title: 'Localidad',
                value: 'localidad'
            },{
                title: 'CUIT / CUIL',
                value: 'cuit_cuil'
            },{
                title: 'CBU',
                value: 'cbu'
            },{
                title: 'Teléfono',
                value: 'telefono'
            },{
                title: 'WhatsApp',
                value: 'whatsapp'
            },{
                title: 'Estado',
                value: 'tipo_estado:nombre'
            },{
                title: 'Fecha de Alta',
                value: 'alta'
            },{
                title: 'Fecha de Baja',
                value: 'baja'
            },{
                title: 'Obras suscriptas',
                value: 'obras:nombre'
            },{
                title: 'Detalles',
                value: 'detalles'
            }]}},
            edit: {
                data: 'slug',
                url: '/panel/usuario'
            },
            delete: {
                data: 'id_usuario',
                url: '/usuario'
            }
        };
    section.cols = [
        { title: '', data: 'estado', },
        { title: 'N° de Suscriptor', data: 'id_suscriptor', },
        { title: 'Correo', data: 'correo', },
        { title: 'Entidad', data: 'entidad', },
        { title: '', data: '{all},id_usuario,slug', actions: section.actions
        },
    ];
    section.tabla = new Table({
        html: document.querySelector('.tab-content-list #tabla_usuarios table'),
        cols: section.cols,
        data: section.filtros.execute(),
    }, clases);
    for(const tab of section.tabs){
        tab.html.addEventListener('click', function(e){
            showSection(section);
        });
    }
}

function fillSection(id, current){
    switch(id){
        case 'tabla_categorias':
            fillTablaCategoriasSection(sections[id]);
            break;
        case 'tabla_educaciones':
            fillTablaEducacionesSection(sections[id]);
            break;
        case 'tabla_eventos':
            fillTablaEventosSection(sections[id]);
            break;
        case 'tabla_facturaciones':
            fillTablaFacturacionesSection(sections[id]);
            break;
        case 'tabla_gestiones':
            fillTablaGestionesSection(sections[id]);
            break;
        case 'tabla_normativas':
            fillTablaNormativasSection(sections[id]);
            break;
        case 'tabla_noticias':
            fillTablaNoticiasSection(sections[id]);
            break;
        case 'tabla_preguntas':
            fillTablaPreguntasSection(sections[id]);
            break;
        case 'tabla_precios':
            fillTablaPreciosSection(sections[id]);
            break;
        case 'tabla_suscriptores':
            fillTablaSuscriptoresSection(sections[id]);
            break;
        case 'tabla_temas':
            fillTablaTemasSection(sections[id]);
            break;
        case 'tabla_usuarios':
            fillTablaUsuariosSection(sections[id]);
            break;
        case 'gestiones':
            fillGestionesSection(sections[id], current);
            break;
        case 'normativas':
            fillNormativasSection(sections[id], current);
            break;
        case 'educaciones':
            fillEducacionesSection(sections[id]);
            break;
    }
}

function loadSection(id, tabmenu, data, current){
    sections[id].data = data;
    for (const content of tabmenu.contents) {
        if (content.properties.id == id) {
            sections[id].content = content;
        }else if(content.checkInsideSection(id)){
            sections[id].content = content;
        }
    }
    sections[id].tabs = [];
    for(const tab of tabmenu.tabs){
        if(tab.target == id){
            sections[id].tabs.push(tab);
        }else if(sections[id].subsections){
            for(const subsection of sections[id].subsections){
                if(tab.target == subsection){
                    sections[id].tabs.push(tab);
                }
            }
        }
    }
    fillSection(id, current);
    return sections[id];
};

function filterSection(sectionsToFilter) {
    for (const id in sections) {
        if (sections.hasOwnProperty(id)) {
            const section = sections[id];
            for (const sectionToFilter of sectionsToFilter) {
                if (sectionToFilter == id && section.opened) {
                    section.tabla.changeData(section.filtros.execute());
                }
            }
        }
    }
}

function changeSelectValue(value) {
    let select = document.querySelector(`select.filter[data-target]`);
    let optSelected;
    for (const option of select.children) {
        option.selected = false;
        if (option.value == value) {
            optSelected = option;
        }
    }
    if (optSelected) {
        optSelected.selected = true;
        changeButtonValue();
        sections.tabla_facturaciones.filtros.changeValue(select.dataset.name, select.value);
        sections.tabla_facturaciones.tabla.changeData(sections.tabla_facturaciones.filtros.execute());
        createTotalValue();
    }
}

function changeButtonValue() {
    let buttons = document.querySelectorAll(`.fecha`);
    let select = document.querySelector(`select.filter[data-target="alta"]`);
    for (const btn of buttons) {
        if (btn.classList.contains('left')) {
            if (parseInt(select.value.split('(-').pop().split('-)').shift()) > 1) {
                let number = (parseInt(select.value.split('(-').pop().split('-)').shift()) - 1);
                if (number < 10) {
                    number = '0' + number;
                }
                btn.value = '(-' + number + '-)';
            } else {
                btn.value = '(-12-)';
            }
        } else {
            if (parseInt(select.value.split('(-').pop().split('-)').shift()) < 12) {
                let number = (parseInt(select.value.split('(-').pop().split('-)').shift()) + 1);
                if (number < 10) {
                    number = '0' + number;
                }
                btn.value = '(-' + number + '-)';
            } else {
                btn.value = '(-01-)';
            }
        }
    }
}

function createTotalValue() {
    let empty = document.createElement('tr');
    empty.classList.add('empty');
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    sections.tabla_facturaciones.tabla.appendTr(empty);
    let td = document.createElement('td');
    empty.appendChild(td);
    td.classList.add('total', 'p-4');
    let span = document.createElement('span');
    td.appendChild(span);
    let value = 0;
    for (const usuario of sections.tabla_facturaciones.data.usuarios) {
        value += usuario.valor_original;
    }
    span.innerHTML = '$' + value;
    empty.appendChild(document.createElement('td'));
}

async function load() {
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
        open: (URL.findHashParameter()) ? [URL.findHashParameter()] : false,
    });

    let LocalStorageInstance = LocalStorageServiceProvider.getData('mutualcoop_token');

    let show = URL.findHashParameter();

    if(LocalStorageInstance.checkData()){
        let url_sections;
        url_sections = [
            {id: 'normativas', url: [
                {id: 'ley', url: '/api/normativas/1'},
                {id: 'decreto', url: '/api/normativas/2'},
                {id: 'resolucion', url: '/api/normativas/3'},
            ]},
            {id: 'gestiones', url: [
                {id: 'administrativo_contable', url: '/api/gestiones/4'},
                {id: 'impositivo', url: '/api/gestiones/5'},
                {id: 'previsional', url: '/api/gestiones/6'},
                {id: 'recursos', url: '/api/gestiones/7'},
                {id: 'analisis_reglamentacion', url: '/api/gestiones/8'},
                {id: 'informacion_coplementaria', url: '/api/gestiones/9'},
                {id: 'jurisprudencia', url: '/api/gestiones/10'},
            ]},
            {id: 'educaciones', url: '/api/educaciones'},
        ];
        let data = await getSuscriptorData(url_sections, tabmenu, LocalStorageInstance, show);

        if(usuario.id_nivel > 1){
            url_sections = [
                {id: 'tabla_categorias', url: '/api/categorias'},
                {id: 'tabla_educaciones', url: '/api/educaciones'},
                {id: 'tabla_eventos', url: '/api/eventos'},
                {id: 'tabla_facturaciones', url: '/api/facturaciones'},
                {id: 'tabla_gestiones', url: '/api/gestiones'},
                {id: 'tabla_normativas', url: '/api/normativas'},
                {id: 'tabla_noticias', url: '/api/noticias'},
                {id: 'tabla_preguntas', url: '/api/preguntas'},
                {id: 'tabla_precios', url: '/api/precios'},
                {id: 'tabla_suscriptores', url: '/api/suscripciones'},
                {id: 'tabla_temas', url: '/api/temas'},
                {id: 'tabla_usuarios', url: '/api/usuarios'},
            ];
            let data = await getAdministradorData(url_sections, tabmenu, LocalStorageInstance, show);
        }

        fillDetallesSection(sections.detalles, tabmenu)
        setImportedData(show, tabmenu);
        
        let obrasCheckboxes = document.querySelectorAll(`.filter[data-target='obras']`);
        for (const html of obrasCheckboxes) {
            html.addEventListener('change', function(e) {
                e.preventDefault();
                filterSection(['tabla_gestiones', 'tabla_normativas', 'tabla_facturaciones', 'tabla_suscriptores', 'tabla_temas', 'tabla_categorias', 'gestiones', 'normativas']);
            });
        }

        let idTipoGestionInputs = document.querySelectorAll(`.filter[data-target='id_tipo_gestion']`);
        for (const html of idTipoGestionInputs) {
            html.addEventListener('click', function(e) {
                e.preventDefault();
                filterSection(['tabla_gestiones', 'tabla_categorias']);
            });
        }

        let idTipoNormativaInputs = document.querySelectorAll(`.filter[data-target='id_tipo_normativa']`);
        for (const html of idTipoNormativaInputs) {
            html.addEventListener('click', function(e) {
                e.preventDefault();
                filterSection(['tabla_normativas']);
            });
        }

        let idTipoSuscripcionInputs = document.querySelectorAll(`.filter[data-target='id_tipo_suscripcion']`);
        for (const html of idTipoSuscripcionInputs) {
            html.addEventListener('click', function(e) {
                e.preventDefault();
                filterSection(['tabla_facturaciones', 'tabla_suscriptores']);
            });
        }

        let idNivelInputs = document.querySelectorAll(`.filter[data-target='id_nivel']`);
        for (const html of idNivelInputs) {
            html.addEventListener('click', function(e) {
                e.preventDefault();
                filterSection(['tabla_usuarios']);
            });
        }

        let idOrganismoInputs = document.querySelectorAll(`.filter[data-target='id_organismo']`);
        for (const html of idOrganismoInputs) {
            html.addEventListener('click', function(e) {
                e.preventDefault();
                filterSection(['tabla_temas']);
            });
        }

        let fechaArrowButtons = document.querySelectorAll(`.fecha`);
        for (const html of fechaArrowButtons) {
            html.addEventListener('click', function(e) {
                e.preventDefault();
                changeSelectValue(this.value);
            });
        }

        let fechaSelects = document.querySelectorAll(`.filter[data-target="alta"]`);
        for (const html of fechaSelects) {
            html.addEventListener('change', function(e) {
                changeButtonValue();
                filterSection(['tabla_facturaciones']);
                createTotalValue();
            });
        }
    
        let cargarMasBtns = document.querySelectorAll(`.filter-next`);
        for(const btn of cargarMasBtns){
            btn.addEventListener('click', function(e){
                e.preventDefault();
                let nextFiltered;
                switch(this.href.split('#').pop()){
                    case 'normativas':
                        nextFiltered = sections.normativas.filtros.next();
                        if(nextFiltered.data){
                            sections.normativas.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'gestiones':
                        nextFiltered = sections.gestiones.filtros.next();
                        if(nextFiltered.data){
                            sections.gestiones.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_categorias':
                        nextFiltered = sections.tabla_categorias.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_categorias.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_eventos':
                        nextFiltered = sections.tabla_eventos.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_eventos.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_facturaciones':
                        nextFiltered = sections.tabla_facturaciones.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_facturaciones.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_gestiones':
                        nextFiltered = sections.tabla_gestiones.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_gestiones.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_normativas':
                        nextFiltered = sections.tabla_normativas.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_normativas.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_preguntas':
                        nextFiltered = sections.tabla_preguntas.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_preguntas.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_suscriptores':
                        nextFiltered = sections.tabla_suscriptores.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_suscriptores.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_temas':
                        nextFiltered = sections.tabla_temas.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_temas.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                    case 'tabla_usuarios':
                        nextFiltered = sections.tabla_usuarios.filtros.next();
                        if(nextFiltered.data){
                            sections.tabla_usuarios.tabla.addRows(nextFiltered.data);
                        }
                        if(!nextFiltered.thereIsNext){
                            this.classList.toggle('hidden');
                        }
                        break;
                }
            });
        }

        let reOrderBtns = document.querySelectorAll(`.filter-order`);
        for (const btn of reOrderBtns) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let order = {
                    by: this.dataset.by,
                    type: this.dataset.type,
                };
                switch (order.type.toUpperCase()) {
                    case 'DESC':
                        this.dataset.type = 'ASC';
                        break;
                    case 'ASC':
                        this.dataset.type = 'DESC';
                        break;
                }
                if (this.children.length) {
                    let icon = this.children[0];
                    if (icon.classList.contains('fa-sort-down')) {
                        icon.classList.remove('fa-sort-down');
                        icon.classList.add('fa-sort-up');
                    } else {
                        icon.classList.remove('fa-sort-up');
                        icon.classList.add('fa-sort-down');
                    }
                } else {
                    let icon = document.createElement('i');
                    icon.classList.add('order-icon', 'fas', 'fa-sort-down', 'ml-3', 'flex', 'items-center');
                    this.appendChild(icon);
                }
                switch(this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.id){
                    case 'normativas':
                        sections.normativas.filtros.changeOrder(order);
                        sections.normativas.tabla.changeData(sections.normativas.filtros.execute());
                        break;
                    case 'gestiones':
                        sections.gestiones.filtros.changeOrder(order);
                        sections.gestiones.tabla.changeData(sections.gestiones.filtros.execute());
                        break;
                    case 'tabla_categorias':
                        sections.tabla_categorias.filtros.changeOrder(order);
                        sections.tabla_categorias.tabla.changeData(sections.tabla_categorias.filtros.execute());
                        break;
                    case 'tabla_eventos':
                        sections.tabla_eventos.filtros.changeOrder(order);
                        sections.tabla_eventos.tabla.changeData(sections.tabla_eventos.filtros.execute());
                        break;
                    case 'tabla_facturaciones':
                        sections.tabla_facturaciones.filtros.changeOrder(order);
                        sections.tabla_facturaciones.tabla.changeData(sections.tabla_facturaciones.filtros.execute());
                        break;
                    case 'tabla_gestiones':
                        sections.tabla_gestiones.filtros.changeOrder(order);
                        sections.tabla_gestiones.tabla.changeData(sections.tabla_gestiones.filtros.execute());
                        break;
                    case 'tabla_normativas':
                        sections.tabla_normativas.filtros.changeOrder(order);
                        sections.tabla_normativas.tabla.changeData(sections.tabla_normativas.filtros.execute());
                        break;
                    case 'tabla_preguntas':
                        sections.tabla_preguntas.filtros.changeOrder(order);
                        sections.tabla_preguntas.tabla.changeData(sections.tabla_preguntas.filtros.execute());
                        break;
                    case 'tabla_suscriptores':
                        sections.tabla_suscriptores.filtros.changeOrder(order);
                        sections.tabla_suscriptores.tabla.changeData(sections.tabla_suscriptores.filtros.execute());
                        break;
                    case 'tabla_temas':
                        sections.tabla_temas.filtros.changeOrder(order);
                        sections.tabla_temas.tabla.changeData(sections.tabla_temas.filtros.execute());
                        break;
                    case 'tabla_usuarios':
                        sections.tabla_usuarios.filtros.changeOrder(order);
                        sections.tabla_usuarios.tabla.changeData(sections.tabla_usuarios.filtros.execute());
                        break;
                }
            });
        }

        changeButtonValue();

        document.querySelector('#tabla_gestiones .sub-seccion-button').addEventListener('click', function(e) {
            showSection(sections.tabla_categorias);
        });

        document.querySelector('#tabla_normativas .sub-seccion-button').addEventListener('click', function(e) {
            showSection(sections.tabla_temas);
        });

        document.querySelector('#tabla_categorias .sub-seccion-button').addEventListener('click', function(e) {
            showSection(sections.tabla_gestiones);
        });

        document.querySelector('#tabla_temas .sub-seccion-button').addEventListener('click', function(e) {
            showSection(sections.tabla_normativas);
        });

        let notifications = [];
        for(const suscription of suscriptions){
            notifications.push(new Notification({
                id: suscription.id,
                code: 300,
                message: suscription.message,
                url: suscription.url,
                method: suscription.method,
            }, {show: true}, {
                element: document.querySelector('.main > div'),
                insertBefore: document.querySelector('.main > div').children[0]
            }));
        }
    
        if(status){
            notifications.push(new Notification({
                id: 'notification-1',
                code: status.code,
                message: status.message,
            }, {show: true}, {
                element: document.querySelector('.main > div .tab-menu'),
                insertBefore: document.querySelector('.main > div .tab-menu').children[0]
            }));
        }

        let notificacionBtns = document.querySelectorAll('.sub-boton');
        for(const btn of notificacionBtns){
            btn.addEventListener('click', function(e){
                let actions = sections.tabla_usuarios.actions;
                showDetalles(actions.more.details, {'{all}': getAData(sections.tabla_usuarios, sections.tabla_usuarios.data[sections.tabla_usuarios.dataKey], this.href.split('id=').pop())});
                showSection(sections.detalles);
            });
        }
    } else {
        window.location.href = '/ingresar';
    }
}

document.addEventListener('DOMContentLoaded', load);