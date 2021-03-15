let resultados = {};
let datos = {};

document.addEventListener('DOMContentLoaded', function(){
    let buscador = {
        elemento: document.querySelector('#search'),
        load(){
            this.elemento.addEventListener('keyup', async function(evento){
                await buscador.autocomplete(this.value);
            });
        },
        autocomplete(data){
            for(let posicion in elementos_array){
                let texto = elementos_array[posicion].titulo;
                if(texto.includes(data)){
                    if(elementos_array[posicion].id_normativa){
                        resultados[elementos_array[posicion].titulo + ' - Normativa: ' + elementos_array[posicion].tipo.nombre] = null;
                        datos[elementos_array[posicion].titulo + ' - Normativa: ' + elementos_array[posicion].tipo.nombre] = "storage/" + elementos_array[posicion].pdf;
                    }else{
                        resultados[elementos_array[posicion].titulo + ' - Gestion: ' + elementos_array[posicion].tipo.nombre] = null;
                        datos[elementos_array[posicion].titulo + ' - Gestion: ' + elementos_array[posicion].tipo.nombre] = "storage/" + elementos_array[posicion].pdf;
                    }
                }
            }
        },
    };

    buscador.load();

    var elems = document.querySelectorAll('.autocomplete');
    var options = undefined;
    var instances = M.Autocomplete.init(elems, options);
});

$(document).ready(function(){
    $('input.autocomplete').autocomplete({
        data: resultados,
        onAutocomplete: function(val) {
            var link = window.open(APP_ROUTE + '/' + datos[val], '_blank');
            link.location;
         },
    });
});