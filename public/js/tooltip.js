/** Espera a que el documento cargue. */
document.addEventListener('DOMContentLoaded', function(){
    /** Una vez hecho captura todos los tooltips existentes. */
    const tooltips = d.querySelectorAll('[data-tooltip]');

    /** Recorre todos y cada uno. */
    for(let i = 0; i < tooltips.length; i++){
        /** Crea las propiedades que va a tener poner defecto. */
        let absolute = false, posicion = 'top';

        /** Obtiene las clases que puedan tener */
        let classes = tooltips[i].className.split(' ');

        /** Las recorremos para determinar si se tiene que cambiar alguna propiedad. */
        for(let j = 0; j < classes.length; j++){
            switch(classes[j]){
                /** 
                 * Las propiedades existentes son:
                 *  [posicion]: pone el mensaje del tooltip en la posicion seleccionada.
                 *  absolute-[posicion]: pone el elemento en la posicion seleccionada.
                 */
                case 'absolute-top':
                    absolute = classes[j];
                break;
                case 'absolute-right':
                    absolute = classes[j];
                break;
                case 'absolute-bottom':
                    absolute = classes[j];
                break;
                case 'absolute-left':
                    absolute = classes[j];
                break;
                case 'right':
                    posicion = classes[j];
                break;
                case 'bottom':
                    posicion = classes[j];
                break;
                case 'left':
                    posicion = classes[j];
                break;
            }
        }

        /** Obtiene el elemento y le asigna su clase. */
        let elemento = tooltips[i];
        elemento.className = 'tooltip';

        /** Obtiene el texto que va a tener el tooltip. */
        let texto = tooltips[i].dataset.tooltip;

        /** Crea el tooltip, poniendo el mensaje y sus propiedades. */
        let span = d.createElement('span');
        span.innerHTML = texto;
        span.className = 'tooltiptext ' + posicion;
        elemento.appendChild(span);

        /** En caso de tener la propiedad absoluta, obtiene al padre del elemento y posiciona al elemento. */
        if(absolute){
            let padre = elemento.parentNode;
            padre.className += ' ' + absolute;
        }
    }
});