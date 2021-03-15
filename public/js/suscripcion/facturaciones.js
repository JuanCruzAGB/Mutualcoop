import { Table } from "../Table/Table.js";
import { Filter } from "../../submodules/FilterJS/js/Filter.js";
import { URL } from "../URL.js";
import { openModal } from "../modal/modal.js";

let clones = [];
for (const usuario of usuarios) {
    if (usuario.id_tipo_suscripcion == 2) {
        clones.push(usuario);
    }
}
for (const usuario of clones) {
    let date = usuario.alta.split('-');
    let year = date[0], month = date[1], day = date[2];
    month = parseInt(month) + 6;
    if (month > 12) {
        if(parseInt(month / 12)){
            month = month - 12;
            year++;
        }
    }
    if(month < 10){
        if (month < 1) {
            month = 1;
        }
        month = `0${ month }`;
    }
    usuarios.push({
        id_usuario: usuario.id_usuario,
        alta: `${ year }-${ month }-${ day }`,
        baja: usuario.baja,
        cbu: usuario.cbu,
        correo: usuario.correo,
        correo_facturacion: usuario.correo_facturacion,
        correo_informacion: usuario.correo_informacion,
        created_at: usuario.created_at,
        cuit_cuil: usuario.cuit_cuil,
        detalles: usuario.detalles,
        direccion: usuario.direccion,
        entidad: usuario.entidad,
        estado: usuario.estado,
        id_nivel: usuario.id_nivel,
        id_suscriptor: usuario.id_suscriptor,
        id_tipo_suscripcion: usuario.id_tipo_suscripcion,
        localidad: usuario.localidad,
        nombre: usuario.nombre,
        obras: usuario.obras,
        provincia: usuario.provincia,
        slug: usuario.slug,
        suscripcion: usuario.suscripcion,
        suscripciones: usuario.suscripciones,
        telefono: usuario.telefono,
        updated_at: usuario.updated_at,
        valor: usuario.valor,
        valores: usuario.valores,
        whatsapp: usuario.whatsapp,
    });
}

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
}]}};

let cols = [ { 
        title: 'N° de Suscriptor', data: 'id_suscriptor', classNames: {
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
        title: 'Provincia', data: 'provincia', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Tipo de Suscripción', data: 'suscripcion', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { 
        title: 'Obras Suscriptas', data: 'obras', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'obras-suscriptas']
    }, }, { 
        title: '', data: 'valor', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal']
    }, }, { title: '', data: '{all}', classNames: {
        th: ['px-4', 'py-2', 'background', 'background-tres', 'text-white', 'text-xs'],
        td: ['border', 'px-4', 'py-2', 'lg:whitespace-normal', 'text-center']
}, actions } ];

function changeFiltersValue(params){
    let filters = document.querySelectorAll('[data-target=id_tipo_suscripcion]');
    if (params.executedBy.properties.name == 'fecha-select') {
        let total = 0, tipo_semestral = 0, tipo_anual = 0;
        for (const data of params.data) {
            total++;
            if (data.id_tipo_suscripcion == 2) {
                tipo_semestral++;
            } else if (data.id_tipo_suscripcion == 3) {
                tipo_anual++;
            }
        }
        filters[0].children[0].children[0].innerHTML = total;
        filters[1].children[0].children[0].innerHTML = tipo_semestral;
        filters[2].children[0].children[0].innerHTML = tipo_anual;
    }
}

function changeTableContent(params = undefined){
    params.tabla.changeData(params.data);
    changeFiltersValue(params);
}

function createTotalValue(tabla, filtros) {
    let empty = document.createElement('tr');
    empty.classList.add('empty');
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    empty.appendChild(document.createElement('td'));
    tabla.appendTr(empty);
    let td = document.createElement('td');
    empty.appendChild(td);
    td.classList.add('total', 'p-4', 'background', 'background-tres', 'text-white');
    let span = document.createElement('span');
    td.appendChild(span);
    let value = 0;
    let dataToFor = filtros.execute();
    for (const usuario of dataToFor) {
        value += usuario.valor;
    }
    let bold = document.createElement('b');
    bold.innerHTML = value;
    span.innerHTML = 'Total: $';
    span.appendChild(bold);
    empty.appendChild(document.createElement('td'));
}

function changeSelectValue(value, tabla, filtros) {
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
        filtros.changeValue(select.dataset.name, select.value);
        let data = filtros.execute();
        tabla.changeData(data);
        changeFiltersValue({
            tabla: tabla,
            executedBy: filtros.rules[0].btns[0],
            data: data,
        });
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

document.addEventListener('DOMContentLoaded', function(e){
    if(usuarios.length){
        let tabla = new Table({
            cols: cols,
            data: [],
        }, document.querySelector('#tabla_facturaciones table'));

        let filtros = new Filter({
            id: 'tabla_facturaciones',
            order: {
                by: 'id_suscriptor',
            },
            resetOnRule: 'alta',
            event: {
                function: changeTableContent,
                params: {
                    tabla: tabla,
                },
            },
        }, {}, [{
            type: 'select',
            target: 'alta',
            value: document.querySelector(`select.filter[data-target="alta"]`).value,
        }, {
            type: 'button',
            target: 'id_tipo_suscripcion',
        }], usuarios);

        let dataFiltered = filtros.execute();
        tabla.changeData(dataFiltered);

        let filters = document.querySelectorAll('[data-target=id_tipo_suscripcion]');
        let total = 0, tipo_semestral = 0, tipo_anual = 0;
        for (const data of dataFiltered) {
            total++;
            if (data.id_tipo_suscripcion == 2) {
                tipo_semestral++;
            } else if (data.id_tipo_suscripcion == 3) {
                tipo_anual++;
            }
        }
        filters[0].children[0].children[0].innerHTML = total;
        filters[1].children[0].children[0].innerHTML = tipo_semestral;
        filters[2].children[0].children[0].innerHTML = tipo_anual;

        if(URL.findHashParameter() == 'detalles'){
            let id = URL.findGetParameter('id');
            for (const usuario of usuarios) {
                if(usuario.id_usuario == id){
                    openModal({type: 'details', data: usuario, info: actions.more.details});
                }
            }
        }
    
        let select = document.querySelector('select.filter');
        select.addEventListener('change', function(e){
            e.preventDefault();
            createTotalValue(tabla, filtros);
            changeButtonValue();
        });

        let fechaArrowButtons = document.querySelectorAll(`.fecha`);
        for (const html of fechaArrowButtons) {
            html.addEventListener('click', function(e) {
                e.preventDefault();
                changeSelectValue(this.value, tabla, filtros);
                createTotalValue(tabla, filtros);
            });
        }

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
            });
        }

        createTotalValue(tabla, filtros);
    }else{
        console.error('No se encontraron Usuarios para mostrar.');
    }
});