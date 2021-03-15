import { Table } from "../Table/Table.js";
import { Filter } from "../../submodules/FilterJS/js/Filter.js";
import { URL } from "../URL.js";
import { openModal } from "../modal/modal.js";

let actions = {
// ! Acción de ver más información.
    more: { data: 'id_usuario', details: [{
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
// ! Acción de editar.
    edit: {
        data: 'slug',
        url: '/panel/usuario'
    },
// ! Acción de borrar.
    delete: {
        data: 'id_usuario',
        url: '/usuario'
} };

let cols = [ { 
    title: '', data: 'estado', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'text-center']
    }, }, { 
        title: 'N° de Suscriptor', data: 'id_suscriptor', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Correo', data: 'correo', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Nombre', data: 'nombre', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Entidad', data: 'entidad', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'entidad']
    }, }, { 
        title: 'Obras Suscriptas', data: 'obras', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'obras-suscriptas']
    }, }, { 
        title: 'Tipo de Suscripción', data: 'suscripcion', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Nivel', data: 'nivel', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { title: '', data: '{all},id_usuario,slug', classNames: {
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
    if(usuarios.length){
        let tabla = new Table({
            cols: cols,
            data: [],
        }, document.querySelector('#tabla_usuarios table'));

        let filtros = new Filter({
            id: 'tabla_usuarios',
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
            target: 'id_suscriptor,correo,nombre,entidad',
        },{
            type: 'button',
            target: 'id_nivel',
        },{
            type: 'checkbox',
            target: 'obras',
        }], usuarios);

        let newUsuarios = filtros.execute();
        tabla.changeData(newUsuarios);
        let nextBtn = document.querySelector('.filter-next');
        for (const usuario of newUsuarios) {
            nextBtn.href = `#usuario-${usuario.id_usuario}`;
        }

        if(URL.findHashParameter() == 'detalles'){
            let id = URL.findGetParameter('id');
            for (const usuario of usuarios) {
                if(usuario.id_usuario == id){
                    openModal({type: 'details', data: usuario, info: actions.more.details});
                }
            }
        }
    
        // let filterBtns = document.querySelectorAll('.filter[data-target=id_nivel]');
        // for (const btn of filterBtns) {
        //     btn.addEventListener('click', function(e){
        //         e.preventDefault();
        //         tabla.changeData(filtros.execute());
        //         addNextButton();
        //     });
        // }

        // let searchBar = document.querySelector('.filter-search');
        // searchBar.addEventListener('keyup', function(e){
        //     tabla.changeData(filtros.execute());
        //     addNextButton();
        // });

        // let obrasBtns = document.querySelectorAll('.filter[name=id_obra]');
        // for (const btn of obrasBtns) {
        //     btn.addEventListener('change', function(e){
        //         tabla.changeData(filtros.execute());
        //         addNextButton();
        //     });
        // }

        document.querySelector('.filter-next').addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = this.href;
            let next = filtros.next();
            if(next){
                tabla.addRows(next.data);
                document.querySelector('#' + this.href.split('#')[1]).classList.add('previous');
                for (const usuario of next.data) {
                    nextBtn.href = `#usuario-${usuario.id_usuario}`;
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
        console.error('No se encontraron Usuarios para mostrar.');
    }
});