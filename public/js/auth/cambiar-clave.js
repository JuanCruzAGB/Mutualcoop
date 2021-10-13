import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
import { Notification } from "../../submodules/NotificationJS/js/Notification.js";

document.addEventListener('DOMContentLoaded', function (e) {
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

    validacion['cambiar-clave'] = new Validation({
        id: 'cambiar-clave',
    },{
        submit: true,
    }, validation['cambiar-clave'].rules, validation['cambiar-clave'].messages);
});