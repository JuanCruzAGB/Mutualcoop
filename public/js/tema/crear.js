import { Validation } from "../../submodules/ValidationJS/js/Validation.js";
document.addEventListener('DOMContentLoaded', function(e){
    new Validation({
        id: 'tema-crear',
    },{
        submit: true,
    }, validation.rules, validation.messages);
});