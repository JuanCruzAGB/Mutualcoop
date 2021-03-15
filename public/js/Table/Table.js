import { Tr } from './Tr.js';

/**
 * * Table controls the creation of the <table>.
 * @export
 * @class Table
 */
export class Table {
    /**
     * * Creates an instance of Table.
     * @param {object} properties - The Table properties.
     * @memberof Table
     */
    constructor(properties = {
        cols: [],
        data: [],
    }, html = null) {
        this.rows = 0;
        this.setHTML(html);
        this.setCols(properties);
        this.setData(properties);

        this.createTHead();
        this.createTBody();
        this.printTable();
    }

    /**
     * * Set the Table HTML Element.
     * @param {HTMLElement} html - Table HTML Element.
     * @memberof Table
     */
    setHTML(html = null) {
        this.html = html;
    }

    /**
     * * Set the Table cols.
     * @param {object} properties - The Table properties.
     * @memberof Table
     */
    setCols(properties = { cols: [] }) {
        this.cols = [];
        for (const col of properties.cols) {
            this.cols.push(col);
        }
    }

    /**
     * * Set the Table Data.
     * @param {object} properties - The Table properties.
     * @memberof Table
     */
    setData(properties = {data: []}){
        if(properties.data && properties.data.length){
            this.data = properties.data;
        } else {
            this.data = [];
        }
    }

    /**
     * * Create <thead>.
     * @memberof Table
     */
    createTHead() {
        this.html.innerHTML = '';
        this.thead = document.createElement('thead');
        this.th = new Tr({ type: 'thead', cols: this.cols, data: [] });
        this.thead.appendChild(this.th.html);
    }

    /**
     * * Create <tbody>.
     * @memberof Table
     */
    createTBody() {
        this.tbody = document.createElement('tbody');
        this.trs = [];
        if (this.data.length) {
            // if (typeof this.data[Symbol.iterator] === 'function') {
            //     for (const data of this.data) {
            //         this.rows++;
            //         let tr = new Tr({ type: 'tbody', cols: this.cols, data: data }, this.ClassList);
            //         this.trs.push(tr);
            //         this.tbody.appendChild(tr.html);
            //     }
            // } else {
                for (const int in this.data) {
                    if (this.data.hasOwnProperty(int)) {
                        const data = this.data[int];
                        this.rows++;
                        let tr = new Tr({ type: 'tbody', cols: this.cols, data: data });
                        this.trs.push(tr);
                        this.tbody.appendChild(tr.html);
                    }
                }
            // }
        } else {
            let emptyTr = Tr.emptyRow(this.cols, this.ClassList);
            this.tbody.appendChild(emptyTr);
        }
    }

    /**
     * * Print the content into the Table HTML Element
     * @memberof Table
     */
    printTable() {
        if (!this.html.contains(this.thead)) {
            this.html.appendChild(this.thead);
        }
        this.html.appendChild(this.tbody);
    }

    /**
     * * Change the Table data and remake the <tbody>.
     * @param {object} data - The new Table data.
     * @memberof Table
     */
    changeData(data) {
        this.html.removeChild(this.tbody);
        this.rows = 0;
        if (data && data.length) {
            this.data = data;
        } else {
            this.data = [];
        }
        this.createTBody();
        this.printTable();
    }

    appendTr(tr) {
        this.tbody.appendChild(tr);
    }

    addRows(dataToFor) {
        for (const position in dataToFor) {
            if (dataToFor.hasOwnProperty(position)) {
                const data = dataToFor[position];
                this.rows++;
                let tr = new Tr({ type: 'tbody', cols: this.cols, data: data }, this.ClassList);
                this.trs.push(tr);
                this.tbody.appendChild(tr.html);
            }
        }
    }
}