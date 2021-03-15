document.addEventListener('DOMContentLoaded', function(){
    let tiposE = {
        actual: '0',
        contenido: document.querySelector('.collection.elementos'),
        elementos: document.querySelectorAll('.collection.elementos a:not(:first-of-type)'),
        show(){
            this.contenido.style.display = 'block';
        },
        hide(){
            this.contenido.style.display = 'none';
        },
        click(boton){
            colleccion.cambiarActivo('tiposE', boton);
            this.actual = boton.dataset.id;

            if(boton.dataset.id == '0'){
                this.mostrarTodo();
            }else if(boton.dataset.id == '1'){
                this.mostrarGestion();
            }else{
                this.mostrarNormativa();
            }

            elementos.cambiarContenido();
            paginador.cambiarDatos(1);
        },
        mostrarTodo(){
            tiposN.hide();
            tiposG.hide();
            organismos.hide();
            temas.hide();
            categorias.hide();
        },
        mostrarGestion(){
            tiposN.hide();
            tiposG.show();
            organismos.hide();
            temas.hide();
            if(tiposG.actual < 6){
                categorias.show();
            }else{
                categorias.hide();
            }
        },
        mostrarNormativa(){
            tiposN.show();
            tiposG.hide();
            organismos.show();
            temas.show();
            categorias.hide();
        },
    };

    let tiposN = {
        actual: '0',
        contenido: document.querySelector('.collection.tipos.normativas'),
        elementos: document.querySelectorAll('.collection.tipos.normativas a:not(:first-of-type)'),
        show(){
            this.contenido.style.display = 'block';
        },
        hide(){
            this.contenido.style.display = 'none';
        },
        click(boton){
            colleccion.cambiarActivo('tiposN', boton);
            this.actual = boton.dataset.id;
            elementos.cambiarContenido();
            paginador.cambiarDatos(1);
        },
    };

    let tiposG = {
        actual: '0',
        contenido: document.querySelector('.collection.tipos.gestiones'),
        elementos: document.querySelectorAll('.collection.tipos.gestiones a:not(:first-of-type)'),
        show(){
            this.contenido.style.display = 'block';
        },
        hide(){
            this.contenido.style.display = 'none';
        },
        click(boton){
            colleccion.cambiarActivo('tiposG', boton);
            this.actual = boton.dataset.id;
            elementos.cambiarContenido();
            paginador.cambiarDatos(1);
            if(this.actual < 6){
                categorias.show();
            }else{
                categorias.hide();
            }
            categorias.mostrarCorrectos();
        },
        mostrarCorrectos(){
            for(let i = 0; i < this.elementos.length; i++){
                this.elementos[i].style.display = 'none';
            }
            switch(obras.actual){
                case '0':
                    for(let i = 0; i < this.elementos.length; i++){
                        this.elementos[i].style.display = 'block';
                    }
                break;
                case '4':
                    for(let i = 0; i < this.elementos.length; i++){
                        this.elementos[i].style.display = 'block';
                    }
                break;
                default:
                    for(let i = 0; i < this.elementos.length; i++){
                        if(this.elementos[i].dataset.id < 7){
                            this.elementos[i].style.display = 'block';
                        }
                    }
                break;
            }
        },
    };

    let organismos = {
        actual: '0',
        contenido:document.querySelector('.collection.organismos'),
        elementos: document.querySelectorAll('.collection.organismos a:not(:first-of-type)'),
        show(){
            this.contenido.style.display = 'block';
        },
        hide(){
            this.contenido.style.display = 'none';
        },
        click(boton){
            colleccion.cambiarActivo('organismos', boton);
            this.actual = boton.dataset.id;
            elementos.cambiarContenido();
            paginador.cambiarDatos(1);
            temas.mostrarCorrectos();
        },
    };

    let temas = {
        actual: '0',
        contenido:document.querySelector('.collection.temas'),
        elementos: document.querySelectorAll('.collection.temas a:not(:first-of-type)'),
        show(){
            this.contenido.style.display = 'block';
        },
        hide(){
            this.contenido.style.display = 'none';
        },
        click(boton){
            colleccion.cambiarActivo('temas', boton);
            this.actual = boton.dataset.id;
            elementos.cambiarContenido();
            paginador.cambiarDatos(1);
        },
        mostrarCorrectos(){
            for(let i = 0; i < this.elementos.length; i++){
                if(organismos.actual == 0){
                    this.elementos[i].style.display = 'block';
                }else if(organismos.actual != this.elementos[i].dataset.organismo && this.elementos[i].dataset.id != 0){
                    this.elementos[i].style.display = 'none';
                    this.elementos[i].className = 'collection-item';
                    if(!document.querySelector('.collection.temas .active')){
                        document.querySelector('.collection.temas a:nth-of-type(2)').className = 'collection-item active';
                    }
                }else{
                    this.elementos[i].style.display = 'block';
                }
            }
        },
    };

    let categorias = {
        actual: '0',
        contenido:document.querySelector('.collection.categorias'),
        elementos: document.querySelectorAll('.collection.categorias a:not(:first-of-type)'),
        show(){
            this.contenido.style.display = 'block';
        },
        hide(){
            this.contenido.style.display = 'none';
        },
        click(boton){
            colleccion.cambiarActivo('categorias', boton);
            this.actual = boton.dataset.id;
            elementos.cambiarContenido();
            paginador.cambiarDatos(1);
        },
        mostrarCorrectos(){
            for(let i = 0; i < this.elementos.length; i++){
                if(tiposG.actual == 0){
                    this.elementos[i].style.display = 'block';
                }else if(tiposG.actual != this.elementos[i].dataset.tipo && this.elementos[i].dataset.id != 0){
                    this.elementos[i].style.display = 'none';
                    this.elementos[i].className = 'collection-item';
                    if(!document.querySelector('.collection.categorias .active')){
                        document.querySelector('.collection.categorias a:nth-of-type(2)').className = 'collection-item active';
                    }
                }else{
                    this.elementos[i].style.display = 'block';
                }
            }
        },
    };

    let obras = {
        actual: '0',
        contenido:document.querySelector('.collection.obras'),
        elementos: document.querySelectorAll('.collection.obras a:not(:first-of-type)'),
        show(){
            this.contenido.style.display = 'block';
        },
        hide(){
            this.contenido.style.display = 'none';
        },
        click(boton){
            colleccion.cambiarActivo('obras', boton);
            this.actual = boton.dataset.id;
            elementos.cambiarContenido();
            paginador.cambiarDatos(1);

            if(tiposE.actual == '1'){
                tiposG.mostrarCorrectos();
            }
        },
    };

    let elementos = {
        contenido: document.querySelector('.contenido ul'),
        array: [],
        habiles: [],
        load(){
            for(let posicion in elementos_array){
                this.array.unshift(elementos_array[posicion]);
            }
            this.cambiarContenido();
        },
        cambiarContenido(){
            let existen = false;
            this.habiles = [];
            for(let posicion in this.array){
                let push = true;
                if(tiposE.actual == '0'){
                    if(this.array[posicion].id_gestion != undefined){
                        if(obras.actual != '0'){
                            for(let i = 0; i < obras_array.length; i++){
                                push = false;
                                if(obras.actual == obras_array[i].id_obra){
                                    for(let j = 0; j < this.array[posicion].vinculos.length; j++){
                                        if(this.array[posicion].vinculos[j].id_obra == parseInt(obras.actual)){
                                            push = true;
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        if(obras.actual != '0'){
                            for(let i = 0; i < obras_array.length; i++){
                                push = false;
                                if(obras.actual == obras_array[i].id_obra){
                                    for(let j = 0; j < this.array[posicion].relaciones.length; j++){
                                        if(this.array[posicion].relaciones[j].id_obra == parseInt(obras.actual)){
                                            push = true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }else if(tiposE.actual == '1'){
                    if(this.array[posicion].id_gestion != undefined){
                        if(obras.actual != '0'){
                            for(let i = 0; i < obras_array.length; i++){
                                if(obras.actual == obras_array[i].id_obra){
                                    push = false;
                                    for(let j = 0; j < this.array[posicion].vinculos.length; j++){
                                        if(this.array[posicion].vinculos[j].id_obra == parseInt(obras.actual)){
                                            push = true;
                                        }
                                    }
                                }
                            }
                        }
                        if(tiposG.actual != '0'){
                            if(this.array[posicion].id_tipo_gestion != parseInt(tiposG.actual)){
                                push = false;
                            }
                        }
                        if(categorias.actual != '0' && tiposG.actual < 6){
                            if(this.array[posicion].id_categoria != categorias.actual){
                                push = false;
                            }
                        }
                    }else{
                        push = false;
                    }
                }else{
                    if(this.array[posicion].id_normativa != undefined){
                        if(obras.actual != '0'){
                            push = false;
                            for(let i = 0; i < obras_array.length; i++){
                                if(obras.actual == obras_array[i].id_obra){
                                    for(let j = 0; j < this.array[posicion].vinculos.length; j++){
                                        if(this.array[posicion].vinculos[j].id_obra == parseInt(obras.actual)){
                                            push = true;
                                        }
                                    }
                                }
                            }
                        }
                        if(temas.actual != '0'){
                            for(let i = 0; i < this.array[posicion].enlaces.length; i++){
                                if(this.array[posicion].enlaces[i].id_tema != parseInt(temas.actual)){
                                    push = false;
                                }
                            }
                        }
                        if(tiposN.actual != '0'){
                            if(this.array[posicion].id_tipo_normativa != parseInt(tiposN.actual)){
                                push = false;
                            }
                        }
                        if(organismos.actual != '0'){
                            if(this.array[posicion].id_organismo != parseInt(organismos.actual)){
                                push = false;
                            }
                        }
                    }else{
                        push = false;
                    }
                }
                if(push){
                    this.habiles.unshift(this.array[posicion]);
                    existen = true;
                }
            }
            if(!existen){
                this.errorContenido();
            }else{
                this.ordenarHabiles();
                this.ponerContenido();
            }
        },
        ordenarHabiles(){
            let array = [];
            for(let posicion in this.habiles){
                let push = false;
                if(array.length == 0){
                    push = true;
                    position = 0;
                }else{
                    for(let i = 0; i < array.length; i++){
                        if(!push){
                            if(this.habiles[posicion].updated_at >= array[i].updated_at && !push){
                                push = true;
                                position = i;
                            }else{
                                push = true;
                                position = array.length;
                            }
                        }
                    }
                }
                if(push){
                    array.splice(position, 0, this.habiles[posicion]);
                }
            }
            this.habiles = array;
        },
        ponerContenido(){
            this.contenido.innerHTML = '';
            paginador.reload();
            let min, max;
            max = paginador.actual * paginador.cantidad;
            min = max - 9;
            let i = 1;
            for(let posicion in this.habiles){
                if(posicion >= min - 1 && posicion <= max - 1){
                    if(i <= paginador.cantidad){
                        i++;
                        this.crearLi(this.habiles[posicion]);
                    }
                }
            }
        },
        crearLi(datos){
            let li = document.createElement('li');
            li.className = 'normativas col s12 m12 l6 pull-l10 xl12 pull-xl11';
            this.contenido.appendChild(li);

            let h3 = document.createElement('h3');
            if(tiposE.actual == '0'){
                if(datos.archivo){
                    for(let i = 0; i < tiposG.elementos.length; i++){
                        if(parseInt(tiposG.elementos[i].dataset.id) == datos.id_tipo_gestion){
                            h3.innerHTML = datos.titulo + ' - Gestion: ' + tiposG.elementos[i].innerHTML;
                        }
                    }
                }else{
                    for(let i = 0; i < tiposN.elementos.length; i++){
                        if(parseInt(tiposN.elementos[i].dataset.id) == datos.id_tipo_normativa){
                            h3.innerHTML = datos.titulo + ' - Normativa: ' + tiposN.elementos[i].innerHTML;
                        }
                    }
                }
            }else if(tiposE.actual == '1'){
                for(let i = 0; i < tiposG.elementos.length; i++){
                    if(parseInt(tiposG.elementos[i].dataset.id) == datos.id_tipo_gestion){
                        h3.innerHTML = datos.titulo + ' - ' + tiposG.elementos[i].innerHTML;
                    }
                }
            }else{
                for(let i = 0; i < tiposN.elementos.length; i++){
                    if(parseInt(tiposN.elementos[i].dataset.id) == datos.id_tipo_normativa){
                        h3.innerHTML = datos.titulo + ' - ' + tiposN.elementos[i].innerHTML;
                    }
                }
            }
            li.appendChild(h3);

            if(datos.copete){
                let p = document.createElement('p');
                p.innerHTML = datos.copete;
                li.appendChild(p);
            }

            let a = document.createElement('a');
            a.id = "verMas";
            a.target = "_blank";
            a.className = "waves-effect waves-light btn";
            if(datos.archivo){
                a.href = '/storage/' + datos.archivo;
            }else{
                a.href = '/storage/' + datos.pdf;
            }
            a.innerHTML = 'Ver más';
            li.appendChild(a);
        },
        errorContenido(){
            this.contenido.innerHTML = '';
            let li = document.createElement('li');
            li.className = 'normativas col s12 m12 l6 pull-l7 xl6 pull-xl7';
            this.contenido.appendChild(li);

            let p = document.createElement('p');
            p.innerHTML = 'Ningun elemento coincide con esos filtros.';
            li.appendChild(p);
        },
    };

    let colleccion = {
        load(){
            for(let i = 0; i < tiposE.elementos.length; i++){
                tiposE.elementos[i].addEventListener('click', function(evento){
                    evento.preventDefault();
                    tiposE.click(this);
                });
            }
            for(let i = 0; i < tiposN.elementos.length; i++){
                tiposN.elementos[i].addEventListener('click', function(evento){
                    evento.preventDefault();
                    tiposN.click(this);
                });
            }
            for(let i = 0; i < tiposG.elementos.length; i++){
                tiposG.elementos[i].addEventListener('click', function(evento){
                    evento.preventDefault();
                    tiposG.click(this);
                });
            }
            for(let i = 0; i < organismos.elementos.length; i++){
                organismos.elementos[i].addEventListener('click', function(evento){
                    evento.preventDefault();
                    organismos.click(this);
                });
            }
            for(let i = 0; i < temas.elementos.length; i++){
                temas.elementos[i].addEventListener('click', function(evento){
                    evento.preventDefault();
                    temas.click(this);
                });
            }
            for(let i = 0; i < categorias.elementos.length; i++){
                categorias.elementos[i].addEventListener('click', function(evento){
                    evento.preventDefault();
                    categorias.click(this);
                });
            }
            for(let i = 0; i < obras.elementos.length; i++){
                obras.elementos[i].addEventListener('click', function(evento){
                    evento.preventDefault();
                    obras.click(this);
                });
            }
        },
        cambiarActivo(filtro, boton){
            if(filtro == 'tiposE'){
                for(let i = 0; i < tiposE.elementos.length; i++){
                    tiposE.elementos[i].className = 'collection-item';
                }
            }else if(filtro == 'tiposN'){
                for(let i = 0; i < tiposN.elementos.length; i++){
                    tiposN.elementos[i].className = 'collection-item';
                }
            }else if(filtro == 'tiposG'){
                for(let i = 0; i < tiposG.elementos.length; i++){
                    tiposG.elementos[i].className = 'collection-item';
                }
            }else if(filtro == 'organismos'){
                for(let i = 0; i < organismos.elementos.length; i++){
                    organismos.elementos[i].className = 'collection-item';
                }
            }else if(filtro == 'temas'){
                for(let i = 0; i < temas.elementos.length; i++){
                    temas.elementos[i].className = 'collection-item';
                }
            }else if(filtro == 'categorias'){
                for(let i = 0; i < categorias.elementos.length; i++){
                    categorias.elementos[i].className = 'collection-item';
                }
            }else{
                for(let i = 0; i < obras.elementos.length; i++){
                    obras.elementos[i].className = 'collection-item';
                }
            }

            boton.className = 'collection-item active';
        },
    };

    let paginador = {
        total: 0,
        cantidad: 10,
        anterior: 1,
        actual: 1,
        siguiente: 2,
        inicio: 1,
        fin: 0,
        contenido: document.querySelector('.paginador .pagination'),
        load(){
            this.contenido.innerHTML = '';
            this.reload();
            this.crearLi();
        },
        reload(){
            this.calcular('total');
            this.calcular('cantidad');
            this.calcular('anterior');
            this.calcular('siguiente');
            this.calcular('limites');
        },
        calcular(funcion){
            switch(funcion){
                case 'total':
                    this.total = elementos.habiles.length / this.cantidad;
                    this.total = this.total.toString();
                    this.total = this.total.split(".");
                    this.total = eval(this.total[0]);
                    if(elementos.habiles.length % this.cantidad != 0){
                        this.total++;
                    }
                break;
                case 'anterior':
                    if(this.actual == 1){
                        this.anterior = 1;
                    }else{
                        this.anterior = this.actual - 1;
                    }
                break;
                case 'siguiente':
                    if(this.actual == this.total){
                        this.siguiente = this.total;
                    }else{
                        this.siguiente = this.actual + 1;
                    }
                break;
                case 'limites':
                    this.inicio = this.actual;
                    for(let i = 9; i >= 0; i--){
                        if(this.actual + i > this.total){
                            if(this.total >= this.cantidad){
                                this.inicio = this.total - 9;
                            }else{
                                this.inicio = 1;
                            }
                        }
                    }
                    if(this.inicio == 1 && this.total >= this.cantidad){
                        this.fin = 10;
                    }else if(this.total >= this.cantidad){
                        this.fin = this.inicio + this.cantidad - 1;
                    }else{
                        this.fin = this.total;
                    }
                break;
            }
        },
        crearLi(){
            this.contenido.innerHTML = '';
            this.izquierda();
            for(let i = this.inicio; i <= this.fin; i++){
                let li = document.createElement('li');
                if(i != this.actual){
                    li.className = 'waves-effect';
                }else{
                    li.className = 'active';
                }
                this.contenido.appendChild(li);
                    let a = document.createElement('a');
                    a.href = '#!';
                    a.innerHTML = i;
                    li.appendChild(a);
                    a.addEventListener('click', function(evento){
                        evento.preventDefault();
                        paginador.cambiarDatos(this.innerHTML);
                    });
            }
            this.derecha();
        },
        izquierda(){
            let li = document.createElement('li');
            this.contenido.appendChild(li);
                let a = document.createElement('a');
                a.href = '#!';
                li.appendChild(a);
            if(this.inicio > 1){
                li.className = 'waves-effect';
                a.addEventListener('click', function(evento){
                    evento.preventDefault();
                    paginador.cambiarDatos(paginador.anterior);
                });
            }else{
                li.className = 'disabled';
                a.addEventListener('click', function(evento){
                    evento.preventDefault();
                });
            }
                    let i = document.createElement('i');
                    i.className = "material-icons";
                    i.innerHTML = "chevron_left";
                    a.appendChild(i);
        },
        derecha(){
            let li = document.createElement('li');
            this.contenido.appendChild(li);
                let a = document.createElement('a');
                a.href = '#!';
            if(this.actual < this.total){
                li.className = 'waves-effect';
                a.addEventListener('click', function(evento){
                    evento.preventDefault();
                    paginador.cambiarDatos(paginador.siguiente);
                });
            }else{
                li.className = 'disabled';
                a.addEventListener('click', function(evento){
                    evento.preventDefault();
                });
            }
                li.appendChild(a);
                    let i = document.createElement('i');
                    i.className = "material-icons";
                    i.innerHTML = "chevron_right";
                    a.appendChild(i);
        },
        cambiarDatos(numero){
            this.actual = parseInt(numero);
            this.load();
            elementos.cambiarContenido();
        },
    };

    let expansor = {
        estado: 'abierto',
        contenido: document.querySelector('.collection.expansor .collection-header'),
        boton: document.querySelector('.collection.expansor .collection-header i'),
        load(){
            this.contenido.addEventListener('click', function(evento){
                evento.preventDefault();
                if(expansor.estado == 'abierto'){
                    expansor.boton.innerHTML = 'expand_less';
                    expansor.estado = 'cerrado';
                    cerrar();
                }else{
                    expansor.boton.innerHTML = 'expand_more';
                    expansor.estado = 'abierto';
                    abrir();
                }
            });
        },
    };

    function cerrar(){
        tiposE.hide();
        tiposN.hide();
        tiposG.hide();
        organismos.hide();
        temas.hide();
        categorias.hide();
        obras.hide();
    }

    function abrir(){
        if(tiposE.actual == '0'){
            tiposE.mostrarTodo();
        }else if(tiposE.actual == '1'){
            tiposE.mostrarGestion();
        }else{
            tiposE.mostrarNormativa();
        }
        tiposE.show();
        obras.show();
    }

    if(elementos_array){
        tiposN.hide();
        tiposG.hide();
        organismos.hide();
        temas.hide();
        categorias.hide();
        elementos.load();
        paginador.load();
        colleccion.load();
        expansor.load();
    }
});