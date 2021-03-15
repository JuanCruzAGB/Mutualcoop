import {Td} from './Td.js';

/**
 * * Tr controls the creation of the <tr>.
 * @export
 * @class Tr
 */
export class Tr{
    /**
     * * Creates an instance of Tr.
     * @param {object} properties - The Tr properties.
     * @param {object} ClassList - The <tr>, <td> and <th> Class List.
     * @memberof Tr
     */
    constructor(properties = {type: 'tbody', cols: [], data: []}){
        this.setType(properties);
        this.setCells(properties);
        this.createTr(properties);
    }

    /**
     * * Set the Tr type.
     * @param {object} properties - The Tr properties.
     * @memberof Tr
     */
    setType(properties = {type: 'tbody'}){
        this.type = properties.type;
    }

    /**
     * * Set the Tr cells.
     * @param {object} properties - The Tr properties.
     * @param {object} ClassList - The <td> and <th> Class List.
     * @memberof Tr
     */
    setCells(properties = {cols: [], data: []}){
        switch(this.type){
            case 'thead':
                    this.ths = [];
                    for(const col of properties.cols){
                        this.ths.push(new Td('thead', col));
                    }
                break;
            case 'tbody':
                    this.tds = [];
                    for(const col of properties.cols){
                        if(!col.actions){
                            this.tds.push(new Td('tbody', col, Td.searchData(col, properties.data)));
                        }else{
                            this.tds.push(new Td('actions', col, Td.searchData(col, properties.data)));
                        }
                    }
                break;
        }
    }

    /**
     * * Create the <tr>.
     * @memberof Tr
     */
    createTr(properties = {type: 'tbody', cols: [], data: []}){
        this.html = document.createElement('tr');
        if(properties.data.hasOwnProperty('id_nivel') && properties.data.id_nivel == 2){
            this.html.classList.add('admin');
        }
        if (properties.data.hasOwnProperty('id_normativa')) {
            this.html.id = `normativa-${properties.data.id_normativa}`;
        } else if (properties.data.hasOwnProperty('id_gestion')) {
            this.html.id = `gestion-${properties.data.id_gestion}`;
        } else if (properties.data.hasOwnProperty('id_educacion')) {
            this.html.id = `educacion-${properties.data.id_educacion}`;
        } else if (properties.data.hasOwnProperty('id_evento')) {
            this.html.id = `evento-${properties.data.id_evento}`;
        } else if (properties.data.hasOwnProperty('id_noticia')) {
            this.html.id = `noticia-${properties.data.id_noticia}`;
        } else if (properties.data.hasOwnProperty('id_tema')) {
            this.html.id = `tema-${properties.data.id_tema}`;
        } else if (properties.data.hasOwnProperty('id_categoria')) {
            this.html.id = `categoria-${properties.data.id_categoria}`;
        } else if (properties.data.hasOwnProperty('id_pregunta')) {
            this.html.id = `pregunta-${properties.data.id_pregunta}`;
        } else if (properties.data.hasOwnProperty('id_precio')) {
            this.html.id = `precio-${properties.data.id_precio}`;
        } else if (properties.data.hasOwnProperty('id_usuario')) {
            this.html.id = `usuario-${properties.data.id_usuario}`;
        }
        switch(this.type){
            case 'thead':
                    for(const th of this.ths){
                        this.html.appendChild(th.html);
                    }
                break;
            case 'tbody':
                    for(const td of this.tds){
                        this.html.appendChild(td.html);
                    }
                break;
        }
    }

    /**
     * * Show an empty tr.
     * @static
     * @param {*} cols
     * @returns
     * @memberof Tr
     */
    static emptyRow(cols){
        let emptyTr = document.createElement('tr');
        let emptyTd = document.createElement('td');
        emptyTr.appendChild(emptyTd);
        emptyTd.classList.add('text-center', 'p-4');
        emptyTd.colSpan = cols.length;
        emptyTd.innerHTML = 'No se encontraron resultados.';
        return emptyTr;
    }
}