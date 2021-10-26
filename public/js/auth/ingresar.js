import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
import { Notification } from "../../submodules/NotificationJS/js/Notification.js";

document.addEventListener('DOMContentLoaded', function (e) {
    let see = document.querySelectorAll('.ver-password');
    for (const btn of see) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            let input = this.nextElementSibling;
            switch(input.type) {
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
    
    validacion.ingresar = new Validation({
        id: 'ingresar',
    },{
        submit: true,
        ignore: ['g-recaptcha-response'],
    }, validation.ingresar.rules, validation.ingresar.messages);
});