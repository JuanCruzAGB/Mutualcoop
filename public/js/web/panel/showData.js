import { openModal } from "../../modal/modal.js";
import { URL } from '../../URL.js';

export let filters = {
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

export let sections = {
    tabla_categorias: {
        id: 'tabla_categorias',
        dataKey: 'categorias',
        primaryKey: 'id_categoria',
    },
    tabla_educaciones: {
        id: 'tabla_educaciones',
        dataKey: 'educaciones',
        primaryKey: 'id_educacion',
    },
    tabla_eventos: {
        id: 'tabla_eventos',
        dataKey: 'eventos',
        primaryKey: 'id_evento',
    },
    tabla_facturaciones: {
        id: 'tabla_facturaciones',
        dataKey: 'usuarios',
        primaryKey: 'id_usuario',
    },
    tabla_gestiones: {
        id: 'tabla_gestiones',
        dataKey: 'gestiones',
        primaryKey: 'id_gestion',
    },
    tabla_normativas: {
        id: 'tabla_normativas',
        dataKey: 'normativas',
        primaryKey: 'id_normativa',
    },
    tabla_noticias: {
        id: 'tabla_noticias',
        dataKey: 'noticias',
        primaryKey: 'id_noticia',
    },
    tabla_preguntas: {
        id: 'tabla_preguntas',
        dataKey: 'preguntas',
        primaryKey: 'id_pregunta',
    },
    tabla_precios: {
        id: 'tabla_precios',
        dataKey: 'precios',
        primaryKey: 'id_precio',
    },
    tabla_suscriptores: {
        id: 'tabla_suscriptores',
        dataKey: 'usuarios',
        primaryKey: 'id_usuario',
    },
    tabla_temas: {
        id: 'tabla_temas',
        dataKey: 'temas',
        primaryKey: 'id_tema',
    },
    tabla_usuarios: {
        id: 'tabla_usuarios',
        dataKey: 'usuarios',
        primaryKey: 'id_usuario',
    },
    normativas: {
        id: 'normativas',
        dataKey: 'normativas',
        primaryKey: 'id_normativa',
        current: undefined,
        subsections: ['ley', 'decreto', 'resolucion']
    },gestiones: {
        id: 'gestiones',
        dataKey: 'gestiones',
        primaryKey: 'id_gestion',
        current: undefined,
        subsections: ['administrativo_contable', 'impositivo', 'previsional', 'recursos', 'analisis_reglamentacion', 'informacion_complementaria', 'jurisprudencia']
    },educaciones: {
        id: 'educaciones',
        dataKey: 'educaciones',
        primaryKey: 'id_educacion',
    },detalles: {
        id: 'detalles',
    }
};

function createSection(key, value){
    let section = document.createElement('section');
    section.classList.add('w-11/12', 'md:w-3/4', 'lg:w-6/12', 'mx-auto', 'pb-4', 'content-box');
        let header = document.createElement('header');
        header.classList.add('header-content', 'background', 'background-uno', 'text-white', 'text-2xl', 'mt-4', 'pl-6', 'p-1');
        section.appendChild(header);
            let h3 = document.createElement('h3');
            h3.classList.add('text-left');
            h3.innerHTML = key;
            header.appendChild(h3);

        let ul = document.createElement('ul');
        section.appendChild(ul);
        if(value){
            if(typeof value == 'object'){
                for(const valueToShow of value){
                    let li = document.createElement('li');
                    li.classList.add('list-estilo', 'p-2');
                    li.innerHTML = valueToShow;
                    ul.appendChild(li);
                }
            }else{
                let li = document.createElement('li');
                li.classList.add('list-estilo', 'p-2');
                li.innerHTML = value;
                ul.appendChild(li);
            }
        }else{
            let li = document.createElement('li');
            li.classList.add('list-estilo', 'p-2');
            li.innerHTML = 'No tiene';
            ul.appendChild(li);
        }

    return section;
}

function createDeleteBtn(data, url){
    let btn = document.createElement('a');
    btn.href = `${url}/${data}/eliminar`;
    btn.title = 'Eliminar';
    btn.classList.add('btn', 'btn-uno', 'btn-rounded', 'font-bold', 'py-2', 'px-4', 'flex', 'justify-center', 'items-center');
        let icon = document.createElement('i');
        icon.classList.add('fas', 'fa-trash', 'text-3xl', );
        btn.appendChild(icon);

    btn.addEventListener('click', function(e) {
        e.preventDefault();
        openModal(`${url}/${data}/eliminar`);
    });
    return btn;
}

function createEditBtn(data, url){
    let btn = document.createElement('a');
    btn.href = `${url}/${data}/editar`;
    btn.classList.add('btn', 'btn-uno', 'btn-rounded', 'font-bold', 'py-2', 'px-4', 'flex', 'justify-center', 'items-center');
    btn.title = 'Editar';
        let icon = document.createElement('i');
        icon.classList.add('fas', 'fa-pen', 'text-3xl', );
        btn.appendChild(icon);
    return btn;
}

function createFileBtn(data, url){
    let btn = document.createElement('a');
    btn.href = `/storage/${data}`
    btn.target = "_blank"
    btn.title = 'Ver Archivo';
    btn.classList.add('btn', 'btn-uno', 'btn-rounded', 'font-bold', 'py-2', 'px-4', 'flex', 'justify-center', 'items-center');
        let icon = document.createElement('i');
        icon.classList.add('fas', 'fa-file', 'text-3xl', );
        btn.appendChild(icon);
    return btn;
}

function createAction(type, data, url){
    let link;
    switch(type){
        case 'delete':
            link = createDeleteBtn(data, url);
            break;
        case 'edit':
            link = createEditBtn(data, url);
            break;
        case 'file':
            link = createFileBtn(data, url);
            break;
    }
    return link;
}

function parseKeyToFind(keyToFind){
    let regexp = new RegExp(":");
    if(regexp.exec(keyToFind)){
        return {element: keyToFind.split(':').shift(), key: keyToFind.split(':').pop()};
    }else{
        return keyToFind;
    }
}

function getValueFromData(keyToFind, dataToFor){
    let auxElement = parseKeyToFind(keyToFind);
    for(const key in dataToFor){
        if(dataToFor.hasOwnProperty('{all}')){
            const data = dataToFor['{all}'];
            if(typeof auxElement == 'string'){
                if(data.hasOwnProperty(auxElement)){
                    return data[auxElement];
                }
            }else{
                if(data.hasOwnProperty(auxElement.element)){
                    if(data[auxElement.element].length){
                        let auxData = [];
                        for(const element of data[auxElement.element]){
                            if(element.hasOwnProperty(auxElement.key)){
                                auxData.push(element[auxElement.key]);
                            }
                        }
                        return auxData;
                    }else if(data[auxElement.element].hasOwnProperty(auxElement.key)){
                        return data[auxElement.element][auxElement.key];
                    }
                }
            }
        }
    }
}

function changeReturnButton(section){
    let returnBtn = document.querySelector('#detalles .sub-seccion-button');
    let sectionToChange
    if(!section){
        section = URL.findGetParameter('section');
    }
    sectionToChange = sections[section];
    returnBtn.href = `#${section}`;
    returnBtn.addEventListener('click', function(e){
        showSection(sectionToChange);
    });
}

export function showDetalles(properties, data){
    let actions = document.querySelector('#detalles .details-actions');
    actions.innerHTML = '';
    let content = document.querySelector('#detalles .details-content');
    content.innerHTML = '';
    changeReturnButton(properties.section);
    for(const action in properties.actions){
        const element = properties.actions[action];
        actions.appendChild(createAction(action, getValueFromData(element.data, data), element.url));
    }
    for(const section of properties.sections){
        content.appendChild(createSection(section.title, getValueFromData(section.value, data)));
    }
}

function showFilter(section) {
    for (const key in filters) {
        if (filters.hasOwnProperty(key)) {
            const filter = filters[key];
            filter.classList.toggle('hidden');
        }
    }
    
    for(const filter of section.filtrosClassName){
        filters[filter].classList.toggle('hidden');
    }
}

function showInfo(sectionToShow) {
    switch (sectionToShow.content.properties.id) {
        case 'tabla_categorias':
            document.querySelector(`[data-name="id_tipo_gestion-todos"] span:last-child`).innerHTML = sectionToShow.data.total;
            document.querySelector(`[data-name="id_tipo_gestion-administrativo_contable"] span:last-child`).innerHTML = sectionToShow.data.administrativo_contable;
            document.querySelector(`[data-name="id_tipo_gestion-analisis_reglamentacion"] span:last-child`).innerHTML = sectionToShow.data.analisis_reglamentacion;
            document.querySelector(`[data-name="id_tipo_gestion-impositivo"] span:last-child`).innerHTML = sectionToShow.data.impositivo;
            document.querySelector(`[data-name="id_tipo_gestion-informacion_complementaria"] span:last-child`).innerHTML = sectionToShow.data.informacion_complementaria;
            document.querySelector(`[data-name="id_tipo_gestion-jurisprudencia"] span:last-child`).innerHTML = sectionToShow.data.jurisprudencia;
            document.querySelector(`[data-name="id_tipo_gestion-previsional"] span:last-child`).innerHTML = sectionToShow.data.previsional;
            document.querySelector(`[data-name="id_tipo_gestion-recursos"] span:last-child`).innerHTML = sectionToShow.data.recursos;
            break;
        case 'tabla_gestiones':
            document.querySelector(`[data-name="id_tipo_gestion-todos"] span:last-child`).innerHTML = sectionToShow.data.total;
            document.querySelector(`[data-name="id_tipo_gestion-administrativo_contable"] span:last-child`).innerHTML = sectionToShow.data.administrativo_contable;
            document.querySelector(`[data-name="id_tipo_gestion-analisis_reglamentacion"] span:last-child`).innerHTML = sectionToShow.data.analisis_reglamentacion;
            document.querySelector(`[data-name="id_tipo_gestion-impositivo"] span:last-child`).innerHTML = sectionToShow.data.impositivo;
            document.querySelector(`[data-name="id_tipo_gestion-informacion_complementaria"] span:last-child`).innerHTML = sectionToShow.data.informacion_complementaria;
            document.querySelector(`[data-name="id_tipo_gestion-jurisprudencia"] span:last-child`).innerHTML = sectionToShow.data.jurisprudencia;
            document.querySelector(`[data-name="id_tipo_gestion-previsional"] span:last-child`).innerHTML = sectionToShow.data.previsional;
            document.querySelector(`[data-name="id_tipo_gestion-recursos"] span:last-child`).innerHTML = sectionToShow.data.recursos;
            break;
        case 'tabla_normativas':
            document.querySelector(`[data-name="id_tipo_normativa-todos"] span:last-child`).innerHTML = sectionToShow.data.total;
            document.querySelector(`[data-name="id_tipo_normativa-ley"] span:last-child`).innerHTML = sectionToShow.data.ley;
            document.querySelector(`[data-name="id_tipo_normativa-decreto"] span:last-child`).innerHTML = sectionToShow.data.decreto;
            document.querySelector(`[data-name="id_tipo_normativa-resolucion"] span:last-child`).innerHTML = sectionToShow.data.resolucion;
            break;
        case 'tabla_facturaciones':
            if(!document.querySelector(`[data-name="id_tipo_suscripcion-debito"]`).classList.contains('hidden')){
                document.querySelector(`[data-name="id_tipo_suscripcion-debito"]`).classList.toggle('hidden');
            }
            document.querySelector(`[data-name="id_tipo_suscripcion-todos"] span:last-child`).innerHTML = sectionToShow.data.total;
            document.querySelector(`[data-name="id_tipo_suscripcion-semestral"] span:last-child`).innerHTML = sectionToShow.data.semestral;
            document.querySelector(`[data-name="id_tipo_suscripcion-anual"] span:last-child`).innerHTML = sectionToShow.data.anual;
            break;
        case 'tabla_suscriptores':
            if(document.querySelector(`[data-name="id_tipo_suscripcion-debito"]`).classList.contains('hidden')){
                document.querySelector(`[data-name="id_tipo_suscripcion-debito"]`).classList.toggle('hidden');
            }
            document.querySelector(`[data-name="id_tipo_suscripcion-todos"] span:last-child`).innerHTML = sectionToShow.data.total;
            document.querySelector(`[data-name="id_tipo_suscripcion-debito"] span:last-child`).innerHTML = sectionToShow.data.debito;
            document.querySelector(`[data-name="id_tipo_suscripcion-semestral"] span:last-child`).innerHTML = sectionToShow.data.semestral;
            document.querySelector(`[data-name="id_tipo_suscripcion-anual"] span:last-child`).innerHTML = sectionToShow.data.anual;
            break;
        case 'tabla_temas':
            document.querySelector(`[data-name="id_organismo-todos"] span:last-child`).innerHTML = sectionToShow.data.total;
            document.querySelector(`[data-name="id_organismo-inaes"] span:last-child`).innerHTML = sectionToShow.data.inaes;
            document.querySelector(`[data-name="id_organismo-otros_organismos"] span:last-child`).innerHTML = sectionToShow.data.otros_organismos;
            break;
        case 'tabla_usuarios':
            document.querySelector(`[data-name="id_nivel-todos"] span:last-child`).innerHTML = sectionToShow.data.total;
            document.querySelector(`[data-name="id_nivel-suscriptores"] span:last-child`).innerHTML = sectionToShow.data.suscriptores;
            document.querySelector(`[data-name="id_nivel-administradores"] span:last-child`).innerHTML = sectionToShow.data.administradores;
            break;
    }
}

export function showSection(sectionToShow) {
    for (const id in sections) {
        if (sections.hasOwnProperty(id)) {
            const section = sections[id];
            if(section.content){
                section.content.close();
                section.opened = false;
            }
        }
    }

    if(sectionToShow.current != undefined){
        for(const element of sectionToShow.data){
            if(element.id == sectionToShow.current){
                sectionToShow.filtros.changeData(element.data[sectionToShow.id]);
            }
        }
    }

    if(sectionToShow.filtros){
        sectionToShow.filtros.reset();
        sectionToShow.tabla.changeData(sectionToShow.filtros.execute());
    }

    sectionToShow.content.open();
    sectionToShow.opened = true;

    showInfo(sectionToShow);
    showFilter(sectionToShow);
}