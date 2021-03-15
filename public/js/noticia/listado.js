import { FetchServiceProvider } from '../Providers/FetchServiceProvider.js';

var data = {};
var current = 1;

export async function getData(URL){
    let headers = {
        "Content-Type": "application/json",
    }
    let FetchInstance = await FetchServiceProvider.getData(URL, headers);
    loadNoticias(FetchInstance.getResponse('data'));
}

function createNoticia(noticia){
    let noticiaHTML = document.createElement('section');
    noticiaHTML.classList.add('noticia', 'w-full', 'md:w-6/12', 'lg:w-4/12');
    document.querySelector('.noticias').appendChild(noticiaHTML);
        let figure = document.createElement('figure');
        figure.classList.add('noticia-img', 'mb-4', 'mx-8');
        noticia.appendChild(figure);
            let img = document.createElement('img');
            img.src = `/storage/${noticia.archivo}`;
            img.alt = noticia.titulo;
            figure.appendChild(img);
        
        let header = document.createElement('header');
        header.classList.add('mb-4');
        noticiaHTML.appendChild(header);
            let h3 = document.createElement(h3);
            h3.classList.add('text-center', 'text-2xl');
            header.appendChild(h3);

        let main = document.createElement('main');
        main.classList.add('px-12');
        noticiaHTML.appendChild(main);
            let p = document.createElement('p');
            p.classList.add('text-gray-600');
            p.innerHTML = noticia.titulo;
            main.appendChild(p);

            let div = document.createElement('div');
            div.classList.add('flex', 'justify-center');
            main.appendChild(div);
                let a = document.createElement('a');
                a.href = `/noticia/${noticia.slug}`;
                a.classList.add('btn', 'btn-dos-transparent', 'px-4', 'py-2', 'rounded', 'text-white', 'mt-4', 'mb-8', 'text-lg');
                a.innerHTML = 'Ver más';
                div.appendChild(a);
}

function deleteNextBtn(){
    let nextBtn = document.querySelector('.filter-next');
    let parent = nextBtn.parentNode;
    parent.removeChild(nextBtn);
    // let p = document.createElement('p');
    // p.innerHTML = 'No se encontraron resultados';
    // p.classList.add('text-gray-600');
    // parent.appendChild(p);
}

function loadNoticias(response = null) {
    stopLoading();
    if(response){
        data = response;
    }
    
    if((data.noticias.length / 6) > current){
        current++;
        let row = 1;
        for (const key in data.noticias) {
            if (data.noticias.hasOwnProperty(key) && (current * 6) > key && row <= 6) {
                row++;
                const noticia = data.noticias[key];
                createNoticia(noticia);
            }
        }
    }else{
        deleteNextBtn();
    }
}

function stopLoading(){
    let nextBtn = document.querySelector('.filter-next');
    nextBtn.innerHTML= 'Cargar más';
    nextBtn.classList.remove('loading-dots');
    nextBtn.addEventListener('click', cargar);
}

function loading(){
    let nextBtn = document.querySelector('.filter-next');
    nextBtn.innerHTML= '';
    nextBtn.classList.add('loading-dots');
    nextBtn.removeEventListener('click', cargar);
}

function cargar(){
    if(!data.noticias){
        loading();
        getData('/api/noticias');
    }else{
        loadNoticias();
    }
}

document.addEventListener('DOMContentLoaded', function (e){
    if(document.querySelector('.filter-next')){
        let nextBtn = document.querySelector('.filter-next');
        nextBtn.addEventListener('click', cargar);
    }
});