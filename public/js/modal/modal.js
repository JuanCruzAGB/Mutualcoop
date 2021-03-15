function sendForm() {
    document.querySelector('.modal-box form').submit();
}

function deleteForm() {
    const modal = document.querySelector('.modal-box .modal-form ');
    if (document.querySelector('.modal-box .modal-form form')) {
        const form = document.querySelector('.modal-box .modal-form form');
        modal.removeChild(form);
    }
}

function showData(properties) {
    const table = document.querySelector('.modal-box .modal-details table');
    table.innerHTML = '';
    for (const info of properties.info) {
        if (properties.data.hasOwnProperty(info.value)) {
            let tr = document.createElement('tr');
            table.appendChild(tr);
            let th = document.createElement('th');
            th.innerHTML = info.title;
            th.classList.add('background', 'background-cuatro', 'text-black', 'w-1/4', 'p-4', 'text-left');
            tr.appendChild(th);

            let td = document.createElement('td');
            td.classList.add('p-4');
            if (properties.data[info.value]) {
                td.innerHTML = properties.data[info.value];
            } else {
                td.innerHTML = 'No tiene';
            }
            tr.appendChild(td);
        }
    }
}

export function closeModal() {
    const modal = document.querySelector('.modal-box');
    modal.classList.toggle('opened');
    modal.classList.toggle('closed');
    deactiveFormModal();
    deactiveDetailsModal();
}

export function openModal(properties) {
    const modal = document.querySelector('.modal-box');
    modal.classList.add('opened');
    modal.classList.remove('closed');


    switch (properties.type) {
        case 'form':
            activeFormModal(properties);
            break
        case 'details':
            activeDetailsModal(properties);
            break
    }
}

function activeFormModal(properties) {
    const modal = document.querySelector('.modal-box .modal-form');
    modal.classList.remove('hidden');
    createForm(properties.url);
}

function activeDetailsModal(properties) {
    const modal = document.querySelector('.modal-box .modal-details');
    modal.classList.remove('hidden');
    showData(properties);
}

function deactiveFormModal() {
    const modal = document.querySelector('.modal-box .modal-form');
    modal.classList.add('hidden');
    deleteForm();
}

function deactiveDetailsModal() {
    const modal = document.querySelector('.modal-box .modal-details');
    modal.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function(e) {
    const modal = document.querySelector('.modal');
    const cerrarBtns = document.querySelectorAll('.cerrar');
    const borrar = document.querySelector('.borrar');
    const aceptar = document.querySelector('.aceptar');
    const cancelar = document.querySelector('.cancelar');

    modal.addEventListener('click', function(e) {
        e.stopPropagation();
    })
    borrar.addEventListener('keyup', function(e) {
        e.preventDefault();
        if (this.value == 'BORRAR') {
            modal.classList.add('aprobada');
        } else if (modal.classList.contains('aprobada')) {
            modal.classList.remove('aprobada');
        }
    })

    for (const btn of cerrarBtns) {
        btn.addEventListener('click', function(e) {
            closeModal();
        })
    }

    aceptar.addEventListener('click', function(e) {
        e.preventDefault();
        if (modal.classList.contains('aprobada')) {
            modal.classList.remove('aprobada');
            borrar.value = '';
            sendForm();
            closeModal();
        }
    })
})

function createForm(url) {
    const modal = document.querySelector('.modal-box');
    let form = document.createElement('form');
    form.action = url;
    form.method = 'post';
    form.classList.add('hidden');
    modal.appendChild(form);
    let csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name=csrf-token]').content;
    form.appendChild(csrfToken);

    let deleteMethod = document.createElement('input');
    deleteMethod.type = 'hidden';
    deleteMethod.name = '_method';
    deleteMethod.value = 'DELETE';
    form.appendChild(deleteMethod);
}