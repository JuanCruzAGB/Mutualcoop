import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
document.addEventListener('DOMContentLoaded', function(e){
    new Validation({
        id: 'educacion-editar',
    },{
        submit: true,
    }, validation.rules, validation.messages);
});