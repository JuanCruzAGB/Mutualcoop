// Preguntas y Respuestas

const closed = document.querySelector('.closed');
const preguntaRespuesta = document.querySelector('.pregunta-respuesta');
const preguntas = document.querySelectorAll('.pregunta');

function switchState(pregunta) {
    if (pregunta.classList.contains('opened')) {
        pregunta.classList.add('closed');
        pregunta.classList.remove('opened');
    } else {
        if (pregunta.classList.contains('closed')) {
            pregunta.classList.remove('closed');
        }
        pregunta.classList.add('opened');
    }
}

function iconoState(icono) {
    if (icono.classList.contains('fa-plus')) {
        icono.classList.add('fa-minus');
        icono.classList.remove('fa-plus');
    } else {
        if (icono.classList.contains('fa-minus')) {
            icono.classList.remove('fa-minus');
        }
        icono.classList.add('fa-plus');
    }
}

for (const pregunta of preguntas) {
    for (const hijo of pregunta.children) {
        if (hijo.classList.contains('pregunta-titulo')) {
            hijo.addEventListener('click', function(e) {
                e.preventDefault();
                switchState(pregunta);
                for (const hijito of this.children) {
                    if (hijito.classList.contains('pregunta-icono')) {
                        iconoState(hijito);
                    }
                }
            });
        }
    }
}