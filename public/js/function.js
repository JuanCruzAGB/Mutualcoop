let filters = {
    'tipo-de-suscripcion': document.querySelector(`.tipo-de-suscripcion`),
    'mes': document.querySelector(`.mes`),
    'nivel': document.querySelector(`.nivel`),
    'tipo-de-normativa': document.querySelector(`.tipo-de-normativa`),
    'tipo-de-gestion': document.querySelector(`.tipo-de-gestion`),
    'filtrar-por-obras': document.querySelector(`.filtrar-por-obras`),
};

let showFilter = function(filtersToShow){
    for(const filter of filters){
        filter.style.display = 'none';
    }
    for(const filter of filtersToShow){
        // filters[filter].style.display = 'none';
    }
}

export {showFilter};