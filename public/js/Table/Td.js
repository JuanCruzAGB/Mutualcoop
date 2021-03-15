import { openModal } from "../modal/modal.js";

/**
 * * Td controls the creation of the <td> or the <th>.
 * @export
 * @class Td
 */
export class Td {
    /**
     * * Creates an instance of Td.
     * @param {string} type - The Td type.
     * @param {object} ClassList - The <td> and <th> Class List.
     * @param {object} properties - The Td properties.
     * @param {object|boolean} data - The Td inner data.
     * @memberof Td
     */
    constructor(type = 'tbody', properties = { title: '', data: '', actions: {} }, data = false) {
        this.setType(type);
        this.setData(data);
        switch (this.type) {
            case 'thead':
                this.createTh(properties);
                break;
            case 'tbody':
                this.createTd(properties);
                break;
            case 'actions':
                this.createActions(properties);
                break;
            case 'empty':
                this.createEmpty();
                break;
        }
    }

    /**
     * * Set the Td type.
     * @param {string} type - The Td type.
     * @memberof Td
     */
    setType(type = 'tbody') {
        this.type = type;
    }

    /**
     * * Sett the data.
     * @param {*} data - The Td inner data.
     * @memberof Td
     */
    setData(data = false) {
        this.data = data;
    }

    /**
     * * Create the <th>.
     * @param {object} properties - The Td properties.
     * @memberof Td
     */
    createTh(properties = { title: '', data: '', classNames: [''] }) {
        this.html = document.createElement('th');
        for (const className of properties.classNames.th) {
            this.html.classList.add(className);
        }
        if (properties.title != '') {
            this.createOrderButton(properties);
        } else {
            this.html.innerHTML = '';
        }
    }

    /**
     * * Create an <a>.
     * @param {object} properties - The Td properties.
     * @memberof Td
     */
    createOrderButton(properties = { title: '', data: '' }) {
        if(properties.data != 'obras' && properties.data != 'suscripcion' && properties.data != 'nivel' && properties.data != 'entidad' && properties.data != 'cuit_cuil' && properties.data != 'telefono' && properties.data != 'provincia' && properties.data != 'categoria' && properties.data != 'tipo_normativa' && properties.data != 'tipo_gestion' && properties.data != 'organismo'){
            let btn = document.createElement('a');
            btn.dataset.by = properties.data;
            btn.dataset.type = 'DESC';
            btn.classList.add('filter-order', 'flex', 'justify-center');
            btn.href = '#';
            btn.innerHTML = properties.title;
            this.html.appendChild(btn);
        }else{
            let p = document.createElement('a');
            p.classList.add('flex', 'justify-center');
            p.innerHTML = properties.title;
            this.html.appendChild(p);
        }
    }

    /**
     * * Create the <td>.
     * @param {object} properties - The Td properties.
     * @memberof Td
     */
    createTd(properties = { data: '', classNames: [''] }) {
        this.html = document.createElement('td');
        for (const className of properties.classNames.td) {
            this.html.classList.add(className);
        }
        switch (properties.data) {
            case 'categoria':
                this.html.innerHTML = this.createTypeName();
                break;
            case 'copete':
                this.html.innerHTML = this.createString();
                break;
            case 'correo':
                this.html.innerHTML = this.createString();
                break;
            case 'cuit_cuil':
                this.html.innerHTML = this.createString();
                break;
            case 'date':
                this.html.innerHTML = this.createString();
                break;
            case 'entidad':
                this.html.innerHTML = this.createString();
                break;
            case 'estado':
                this.html.appendChild(this.createState());
                break;
            case 'fecha':
                this.html.innerHTML = this.createString();
                break;
            case 'id_obra':
                this.html.appendChild(this.createObra());
                break;
            case 'id_suscriptor':
                this.html.innerHTML = this.createString();
                break;
            case 'minified':
                this.html.innerHTML = this.createString();
                break;
            case 'nivel':
                this.html.innerHTML = this.createTypeName();
                break;
            case 'nombre':
                this.html.innerHTML = this.createString();
                break;
            case 'obras':
                this.html.appendChild(this.createObras());
                break;
            case 'organismo':
                this.html.innerHTML = this.createTypeName();
                break;
            case 'privado':
                this.html.appendChild(this.createPrivate());
                break;
            case 'pregunta':
                this.html.innerHTML = this.createString();
                break;
            case 'provincia':
                this.html.innerHTML = this.createString();
                break;
            case 'respuesta':
                this.html.innerHTML = this.createString();
                break;
            case 'suscripcion':
                this.html.innerHTML = this.createTypeName();
                break;
            case 'telefono':
                this.html.innerHTML = this.createString();
                break;
            case 'tipo_gestion':
                this.html.innerHTML = this.createTypeName();
                break;
            case 'tipo_normativa':
                this.html.innerHTML = this.createTypeName();
                break;
            case 'titulo':
                this.html.innerHTML = this.createString();
                break;
            case 'valor':
                this.html.innerHTML = this.createPrice();
                break;
            case 'valor_anual':
                this.html.innerHTML = this.createPrice();
                break;
            case 'valor_mensual':
                this.html.innerHTML = this.createPrice();
                break;
            case 'valor_semestral':
                this.html.innerHTML = this.createPrice();
                break;
        }
    }

    /**
     * * Create a string from the data.
     * @returns
     * @memberof Td
     */
    createString() {
        if (this.data !== null && this.data !== false) {
            return this.data;
        } else {
            return 'No tiene';
        }
    }

    /**
     * * Create a price from the data.
     * @returns
     * @memberof Td
     */
    createPrice() {
        return '$' + this.data;
    }

    /**
     * * Create an icon from the data.
     * @returns
     * @memberof Td
     */
    createState() {
        let icon = document.createElement('i');
        switch (this.data.id_estado) {
            case 0:
                icon.classList.add('fas', 'fa-ban');
                icon.title = 'Usuario Dado de baja';
                return icon;
            case 1:
                icon.classList.add('fas', 'fa-envelope');
                icon.title = 'Usuario Pendiente de Confirmación';
                return icon;
            case 2:
                icon.classList.add('fas', 'fa-times');
                icon.title = 'Usuario Pendiente de Aprobación';
                return icon;
            case 3:
                icon.classList.add('fas', 'fa-check');
                icon.title = 'Usuario Activo';
                return icon;
        }
    }

    /**
     * * Create an icon from the data.
     * @returns
     * @memberof Td
     */
    createPrivate() {
        let icon = document.createElement('i');
        switch (this.data) {
            case 1:
                icon.classList.add('fas', 'fa-lock');
                return icon;
            case 0:
                icon.classList.add('fas', 'fa-lock-open');
                return icon;
        }
    }

    createTypeName() {
        if(this.data){
            return this.data.nombre;
        }else{
            return 'No tiene';
        }
    }

    createObra() {
        let div = document.createElement('div');
        switch (this.data) {
            case 1:
                div.innerHTML = 'Cooperativas Completas';
                break;
            case 2:
                div.innerHTML = 'Cooperativas de Trabajo';
                break;
            case 3:
                div.innerHTML = 'Asociaciones Mutuales';
                break;
            case 4:
                div.innerHTML = 'UIF';
                break;
        }
        return div;
    }

    createObras() {
        let div = document.createElement('div');
        if (this.data.length) {
            let paragraph = document.createElement('p');
            div.appendChild(paragraph);
            for (const int in this.data) {
                if (this.data.hasOwnProperty(int)) {
                    const obra = this.data[int];
                    if((parseInt(int) + 1 ) < this.data.length){
                        paragraph.innerHTML += ` ${obra.nombre},`;
                    }else{
                        paragraph.innerHTML += ` ${obra.nombre}`;
                    }
                }
            }
        } else {
            div = 'No tiene';
        }
        return div;
    }

    /**
     * * Create the list of actions.
     * @param {object} properties - The Td properties.
     * @memberof Td
     */
    createActions(properties = { actions: {} }) {
        this.html = document.createElement('td');
        for (const className of properties.classNames.td) {
            this.html.classList.add(className);
        }
        for (const action in properties.actions) {
            switch (action) {
                case 'delete':
                    this.createDeleteBtn(this.html, properties);
                    break;
                case 'edit':
                    this.createEditBtn(this.html, properties);
                    break;
                case 'file':
                    this.createFileBtn(this.html, properties);
                    break;
                case 'more':
                    this.createMoreBtn(this.html, properties);
                    break;
            }
        }
    }

    /**
     * * Create the "delete action".
     * @param {HTMLElement} td - The <td> parent.
     * @memberof Td
     */
    createDeleteBtn(td, properties = { title: '', data: '', actions: {} }) {
        let btn = document.createElement('a');
        btn.href = `${properties.actions.delete.url}/${this.data[properties.actions.delete.data]}/eliminar`;
        btn.title = 'Eliminar';
        btn.classList.add('btn', 'btn-dos-transparent', 'no-text', 'p-1');
        td.appendChild(btn);
        let icon = document.createElement('i');
        icon.classList.add('icon', 'fas', 'fa-trash', 'text-3xl', );
        btn.appendChild(icon);

        let data = this.data;
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal({type: 'form', url: `${properties.actions.delete.url}/${data[properties.actions.delete.data]}/eliminar`});
        });
    }

    /**
     * * Create the "edit action".
     * @param {HTMLElement} td - The <td> parent.
     * @memberof Td
     */
    createEditBtn(td, properties = { title: '', data: '', actions: {} }) {
        let btn = document.createElement('a');
        if (typeof this.data == 'object') {
            btn.href = `${properties.actions.edit.url}/${this.data[properties.actions.edit.data]}/editar`;
        } else {
            btn.href = `${properties.actions.edit.url}/${this.data}/editar`;
        }
        btn.classList.add('btn', 'btn-dos-transparent', 'no-text', 'mr-1', 'mb-1', 'p-1');
        btn.title = 'Editar';
        td.appendChild(btn);
        let icon = document.createElement('i');
        icon.classList.add('icon', 'fas', 'fa-pen', 'text-3xl', );
        btn.appendChild(icon);

        let data = this.data;
    }

    /**
     * * Create the "see file action".
     * @param {HTMLElement} td - The <td> parent.
     * @memberof Td
     */
    createFileBtn(td, properties = { title: '', data: '', actions: {} }) {
        let btn = document.createElement('a');
        btn.href = `/storage/${this.data[properties.actions.file.data]}`
        btn.target = "_blank"
        btn.title = 'Ver Archivo';
        btn.classList.add('btn', 'btn-dos-transparent', 'no-text', 'mr-1', 'mb-1', 'p-1');
        td.appendChild(btn);
        let icon = document.createElement('i');
        icon.classList.add('icon', 'fas', 'fa-file', 'text-3xl', );
        btn.appendChild(icon);

        let data = this.data;
    }

    /**
     * * Create the "see more action".
     * @param {HTMLElement} td - The <td> parent.
     * @memberof Td
     */
    createMoreBtn(td, properties = { title: '', data: '', actions: {} }) {
        let btn = document.createElement('a');
        btn.href = `#detalles?id=${this.data[properties.actions.more.data]}`
        btn.title = 'ver más';
        btn.classList.add('more-button', 'btn', 'btn-dos-transparent', 'no-text', 'mr-1', 'mb-1', 'p-1');
        td.appendChild(btn);
        let icon = document.createElement('i');
        icon.classList.add('icon', 'fas', 'fa-eye', 'text-3xl', );
        btn.appendChild(icon);
        let data;
        if(this.data.hasOwnProperty('{all}')){
            data = this.data['{all}'];
        }else{
            data = this.data;
        }
        btn.addEventListener('click', function(e){
            openModal({type: 'details', data: data, info: properties.actions.more.details});
        });
    }

    /**
     * * Create an empty <th>.
     * @memberof Td
     */
    createEmpty() {
        this.html = document.createElement('th');
    }

    /**
     * * Return the data from a <td>.
     * @static
     * @param {object} properties - The col properties.
     * @param {object} data - The Td inner data.
     * @returns
     * @memberof Td
     */
    static searchData(properties = { data: '' }, data = []) {
        if (properties.data.split(',').length > 1) {
            let dataToSearch = properties.data.split(',');
            let auxData = {};
            for (const info in data) {
                for (const dataName of dataToSearch) {
                    if(dataName == '{all}'){
                        auxData[dataName] = data;
                    }else if (info == dataName) {
                        auxData[info] = data[info];
                    }
                }
            }
            return auxData
        } else {
            for (const info in data) {
                if(properties.data == '{all}'){
                    return data;
                }else if (info == properties.data) {
                    return data[info];
                }
            }
        }
    }
}