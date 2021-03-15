/**
 * * List controls the creation of the <table>.
 * @export
 * @class List
 */
export class List {
    /**
     * * Creates an instance of List.
     * @param {object} properties - The List properties.
     * @memberof List
     */
    constructor(properties = {
        data: [],
    }, html = null) {
        this.rows = 0;
        this.setHTML(html);
        this.setData(properties);
        this.createMain();
    }

    /**
     * * Set the List HTML Element.
     * @param {HTMLElement} html - List HTML Element.
     * @memberof List
     */
    setHTML(html = null) {
        this.html = html;
    }

    /**
     * * Set the List Data.
     * @param {object} properties - The List properties.
     * @memberof List
     */
    setData(properties = {data: []}){
        if(properties.data && properties.data.length){
            this.data = properties.data;
        } else {
            this.data = [];
        }
    }

    /**
     * * Create the List.
     * @memberof List
     */
    createMain() {
        this.html.innerHTML = '';
        this.list = [];
        if (this.data.length) {
            if(document.querySelector('.emptyDiv')){
                document.querySelector('.emptyDiv').parentNode.removeChild(document.querySelector('.emptyDiv'));
            }
            for (const int in this.data) {
                if (this.data.hasOwnProperty(int)) {
                    const data = this.data[int];
                    this.rows++;
                    let list = document.createElement('div');
                    list.classList.add('mb-8');
                    if (data.hasOwnProperty('id_normativa')) {
                        list.id = `normativa-${data.id_normativa}`;
                    } else if (data.hasOwnProperty('id_gestion')) {
                        list.id = `gestion-${data.id_gestion}`;
                    } else if (data.hasOwnProperty('id_educacion')) {
                        list.id = `educacion-${data.id_educacion}`;
                    }
                    this.list.push(list);
                    this.html.appendChild(list);
                        let ul = document.createElement('ul');
                        list.appendChild(ul);
                            let li1 = document.createElement('li');
                            li1.classList.add('mt-4', 'text-xl', 'font-bold');
                            li1.innerHTML = data.titulo;
                            ul.appendChild(li1);

                            if(data.copete){
                                let li2 = document.createElement('li');
                                li2.classList.add('mt-4', 'text-lg', 'w-10/12');
                                li2.innerHTML = data.copete;
                                ul.appendChild(li2);
                            }

                        let div = document.createElement('div');
                        div.classList.add('mx-auto');
                        list.appendChild(div);
                            let btn = document.createElement('a');
                            div.appendChild(btn);
                            btn.classList.add('btn','btn-dos','flex','justify-center','p-1','mt-8');
                            btn.target = '_blank';
                            btn.href = `/storage/${data.archivo}`;
                            btn.innerHTML = 'Ver más';
                        if (data.hasOwnProperty('id_gestion') && data.hasOwnProperty('id_categoria') && data.id_categoria) {
                            let span = document.createElement('span');
                            div.appendChild(span);
                            span.classList.add('ml-3', 'text', 'text-tres');
                            span.innerHTML = data.categoria.nombre;
                        }
                }
            }
        } else {
            let emptyDiv = document.createElement('div');
            emptyDiv.classList.add('w-full', 'flex', 'justify-center', 'emptyDiv');
            this.html.parentNode.insertBefore(emptyDiv, this.html.nextElementSibling);
            let paragraph;
            if (document.querySelector('.not-found')) {
                paragraph = document.querySelector('.not-found');
                paragraph.innerHTML = 'No se encontraron resultados';
            } else {
                paragraph = document.createElement('div');
                paragraph.classList.add('not-found', 'text-gray-600');
                paragraph.innerHTML = 'No se encontraron resultados';
                emptyDiv.appendChild(paragraph);
            }
        }
    }

    /**
     * * Change the List data and remake the <tbody>.
     * @param {object} data - The new List data.
     * @memberof List
     */
    changeData(data) {
        this.rows = 0;
        if (data && data.length) {
            this.data = data;
        } else {
            this.data = [];
        }
        this.createMain();
    }

    addRows(dataToFor) {
        if (dataToFor.length) {
            if(document.querySelector('.emptyDiv')){
                document.querySelector('.emptyDiv').parentNode.removeChild(document.querySelector('.emptyDiv'));
            }
            for (const int in dataToFor) {
                if (dataToFor.hasOwnProperty(int)) {
                    const data = dataToFor[int];
                    this.rows++;
                    let list = document.createElement('div');
                    list.classList.add('mb-8');
                    if (data.hasOwnProperty('id_normativa')) {
                        list.id = `normativa-${data.id_normativa}`;
                    } else if (data.hasOwnProperty('id_gestion')) {
                        list.id = `gestion-${data.id_gestion}`;
                    } else if (data.hasOwnProperty('id_educacion')) {
                        list.id = `educacion-${data.id_educacion}`;
                    }
                    this.list.push(list);
                    this.html.appendChild(list);
                        let ul = document.createElement('ul');
                        list.appendChild(ul);
                            let li1 = document.createElement('li');
                            li1.classList.add('mt-4', 'text-xl', 'font-bold');
                            li1.innerHTML = data.titulo;
                            ul.appendChild(li1);

                            if(data.copete){
                                let li2 = document.createElement('li');
                                li2.classList.add('mt-4', 'text-lg', 'w-10/12');
                                li2.innerHTML = data.copete;
                                ul.appendChild(li2);
                            }

                        let div = document.createElement('div');
                        div.classList.add('mx-auto');
                        list.appendChild(div);
                            let btn = document.createElement('a');
                            div.appendChild(btn);
                            btn.classList.add('btn','btn-dos','flex','justify-center','p-1','mt-8');
                            btn.target = '_blank';
                            btn.href = `/storage/${data.archivo}`;
                            btn.innerHTML = 'Ver más';
                        if (data.hasOwnProperty('id_gestion') && data.hasOwnProperty('id_categoria') && data.id_categoria) {
                            let span = document.createElement('span');
                            div.appendChild(span);
                            span.classList.add('ml-3', 'text', 'text-tres');
                            span.innerHTML = data.categoria.nombre;
                        }
                }
            }
        } else {
            let emptyDiv = document.createElement('div');
            emptyDiv.classList.add('w-full', 'flex', 'justify-center', 'emptyDiv');
            this.html.parentNode.insertBefore(emptyDiv, this.html.nextElementSibling);
            let paragraph;
            if (document.querySelector('.not-found')) {
                paragraph = document.querySelector('.not-found');
                paragraph.innerHTML = 'No se encontraron resultados';
            } else {
                paragraph = document.createElement('div');
                paragraph.classList.add('not-found', 'text-gray-600');
                paragraph.innerHTML = 'No se encontraron resultados';
                emptyDiv.appendChild(paragraph);
            }
        }
    }
}