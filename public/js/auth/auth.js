import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
import { Notification } from "../../submodules/NotificationJS/js/Notification.js";
import { provincias } from "../provincias.js";

function changeElements(option){
    let obrasHTML = document.querySelectorAll('.registrar_obras');
    switch(option.value){
        case '1':
            for (const obra of obras) {
                let float = parseFloat(parseInt(obra.valor_anual) / 12).toFixed(2);
                if (float.split('.')[1] == '00') {
                    float = float.split('.')[0];
                }
                obrasHTML[parseInt(obra.id_obra) - 1].innerHTML = `${obra.nombre} <span class="text text-tres">$${float}</span>`;
            }
            document.querySelector('[name="registrar_cbu"]').classList.remove('hidden');
            document.querySelector('.support-registrar_cbu').classList.remove('hidden');
            document.querySelector('[name="registrar_cbu"]').value = '';
            break;
        case '3':
            for (const obra of obras) {
                obrasHTML[parseInt(obra.id_obra) - 1].innerHTML = `${obra.nombre} <span class="text text-tres">$${obra.valor_anual}</span>`;
            }
            document.querySelector('[name="registrar_cbu"]').classList.add('hidden');
            document.querySelector('.support-registrar_cbu').classList.add('hidden');
            document.querySelector('[name="registrar_cbu"]').value = '0000000000000000000000';
            break;
    }
}

function createOptions(){
    let provinciasSelect = document.querySelector('[name=registrar_provincia]');
    for(const localidad of provincias.provincias){
        let option = document.createElement('option');
        if(oldProvincia && oldProvincia == localidad.nombre){
            option.selected = true;
        }
        option.value = localidad.nombre;
        option.innerHTML = localidad.nombre;
        provinciasSelect.appendChild(option);
    }
}

document.addEventListener('DOMContentLoaded', function(e){
    if (window.location.pathname.split('/')[1] == 'ingresar') {
        createOptions();
    }
    
    let btns = document.querySelectorAll('.change-view');
    let forms = document.querySelectorAll('.auth-form');
    for(const btn of btns){
        btn.addEventListener('click', function(e){
            for(const form of forms){
                if(form.id == this.href.split('#').pop()){
                    form.style.display = 'block';
                }else{
                    form.style.display = 'none';
                }
            }
        });
    }
    if(window.location.href.split('#').length > 1){
        for(const form of forms){
            if(form.id == window.location.href.split('#').pop()){
                form.style.display = 'block';
            }else{
                form.style.display = 'none';
            }
        }
    }else{
        for(const form of forms){
            if(form.id == window.location.href.split('#').pop()){
                form.style.display = 'block';
            }else{
                form.style.display = 'none';
            }
        }
        forms[0].style.display = 'block';
    }

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

    if (window.location.pathname.split('/')[1] == 'ingresar') {
        changeElements(document.querySelector('[name="registrar_id_tipo_suscripcion"]').options[document.querySelector('[name="registrar_id_tipo_suscripcion"]').selectedIndex]);

        document.querySelector('[name="registrar_id_tipo_suscripcion"]').addEventListener('change', function(e){
            changeElements(this.options[this.selectedIndex]);
        });
    }

    let notifications = [];
    if(status){
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
    
    if(document.querySelector('#ingresar')){
        validacion.ingresar = new Validation({
            id: 'ingresar',
        },{
            submit: true,
        }, validation.ingresar.rules, validation.ingresar.messages);
        validacion.registrar = new Validation({
            id: 'registrar',
        },{
            submit: true,
        }, validation.registrar.rules, validation.registrar.messages);

        let steps = document.querySelectorAll('.step');
        let stepsBtns = document.querySelectorAll('.step-button');
        for(const btn of stepsBtns){
            btn.addEventListener('click', function(e){
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
                        for(const step of steps){
                            if(step.classList.contains(this.href.split('#').pop())){
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
                        for(const step of steps){
                            if(step.classList.contains(this.href.split('#').pop())){
                                step.style.display = 'block';
                            }else{
                                step.style.display = 'none';
                            }
                        }
                    }
                } else {
                    for(const step of steps){
                        if(step.classList.contains(this.href.split('#').pop())){
                            step.style.display = 'block';
                        }else{
                            step.style.display = 'none';
                        }
                    }
                }
            });
        }
    }
    if (window.location.pathname.split('/')[1] == 'ingresar') {
        validacion.cambiar_clave = new Validation({
            id: 'cambiar_clave',
        },{
            submit: true,
        }, validation.cambiar_clave.rules, validation.cambiar_clave.messages);
    } else {
        validacion = new Validation({
            id: 'cambiar_clave',
        },{
            submit: true,
        }, validation.rules, validation.messages);
    }
});