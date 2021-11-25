import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
import { Notification } from "../../submodules/NotificationJS/js/Notification.js";
import { provincias } from "../provincias.js";

function changeElements (option) {
    console.log(obras);
    let obrasHTML = document.querySelectorAll('.obras li label');
    console.log(obrasHTML);
    switch (option.value) {
        case '1':
            for (const obra of obras) {
                let float = parseFloat(parseInt(obra.valor_anual) / 12).toFixed(2);
                if (float.split('.')[1] == '00') {
                    float = float.split('.')[0];
                }
                for (const label of obrasHTML) {
                    if (document.querySelector(`input#${ label.htmlFor }`).value == obra.id_obra) {
                        label.innerHTML = `${ obra.nombre } <span class="text text-tres">$${ float }</span>`;
                    }
                }
            }
            document.querySelector('[name="cbu"]').classList.remove('hidden');
            document.querySelector('.support-cbu').classList.remove('hidden');
            document.querySelector('[name="cbu"]').value = '';
            break;
        case '3':
            for (const obra of obras) {
                for (const label of obrasHTML) {
                    if (document.querySelector(`input#${ label.htmlFor }`).value == obra.id_obra) {
                        label.innerHTML = `${ obra.nombre } <span class="text text-tres">$${ obra.valor_anual }</span>`;
                    }
                }
            }
            document.querySelector('[name="cbu"]').classList.add('hidden');
            document.querySelector('.support-cbu').classList.add('hidden');
            document.querySelector('[name="cbu"]').value = '0000000000000000000000';
            break;
    }
}

function createOptions () {
    let provinciasSelect = document.querySelector('[name=provincia]');
    for (const localidad of provincias.provincias) {
        let option = document.createElement('option');
        if (oldProvincia && oldProvincia == localidad.nombre) {
            option.selected = true;
        }
        option.value = localidad.nombre;
        option.innerHTML = localidad.nombre;
        provinciasSelect.appendChild(option);
    }
}

document.addEventListener('DOMContentLoaded', function (e) {
    createOptions();

    changeElements(document.querySelector('[name="id_tipo_suscripcion"]').options[document.querySelector('[name="id_tipo_suscripcion"]').selectedIndex]);

    document.querySelector('[name="id_tipo_suscripcion"]').addEventListener('change', function (e) {
        changeElements(this.options[this.selectedIndex]);
    });

    let see = document.querySelectorAll('.ver-password');
    for(const btn of see){
        btn.addEventListener('click', function(e){
            e.preventDefault();
            let input = this.nextElementSibling;
            switch(input.type){
                case 'password':
                    input.type = 'text';
                    this.children[0].classList.remove('fa-eye');
                    this.children[0].classList.add('fa-eye-slash');
                    break;
                case 'text':
                    input.type = 'password';
                    this.children[0].classList.remove('fa-eye-slash');
                    this.children[0].classList.add('fa-eye');
                    break;
            }
        });
    }

    let notifications = [];
    if (status) {
        notifications.push(new Notification({
            id: 'notification-1',
            code: status.code,
            message: status.message,
        }, {show: true}, {
            element: document.querySelector('.authentication header'),
            insertBefore: document.querySelector('.authentication header').children[0]
        }));
        window.location.href = '#notification-1';
    }

    let validacion = {};
    
    validacion.registrar = new Validation({
        id: 'registrar',
    },{
        submit: true,
    }, validation.registrar.rules, validation.registrar.messages);

    let steps = document.querySelectorAll('.step');
    let stepsBtns = document.querySelectorAll('.step-button');
    for (const btn of stepsBtns) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            let valid = true;
            if (this.classList.contains('step-1-button')) {
                Validation.validate(validacion.registrar.form, validacion.registrar.form.inputs[0]);
                valid = validacion.registrar.getValid();
                Validation.validate(validacion.registrar.form, validacion.registrar.form.inputs[1]);
                if (valid) {
                    valid = validacion.registrar.getValid();
                }
                Validation.validate(validacion.registrar.form, validacion.registrar.form.inputs[2]);
                if (valid) {
                    valid = validacion.registrar.getValid();
                }
                if (valid) {
                    for (const step of steps) {
                        if (step.classList.contains(this.href.split('#').pop())) {
                            step.style.display = 'block';
                        }else{
                            step.style.display = 'none';
                        }
                    }
                }
            } else if (this.classList.contains('step-2-button')) {
                Validation.validate(validacion.registrar.form, validacion.registrar.form.inputs[3]);
                if (valid) {
                    valid = validacion.registrar.getValid();
                }
                Validation.validate(validacion.registrar.form, validacion.registrar.form.inputs[4]);
                if (valid) {
                    valid = validacion.registrar.getValid();
                }
                Validation.validate(validacion.registrar.form, validacion.registrar.form.inputs[5]);
                if (valid) {
                    valid = validacion.registrar.getValid();
                }
                if (valid) {
                    for (const step of steps) {
                        if (step.classList.contains(this.href.split('#').pop())) {
                            step.style.display = 'block';
                        }else{
                            step.style.display = 'none';
                        }
                    }
                }
            } else {
                for (const step of steps) {
                    if (step.classList.contains(this.href.split('#').pop())) {
                        step.style.display = 'block';
                    }else{
                        step.style.display = 'none';
                    }
                }
            }
        });
    }
});