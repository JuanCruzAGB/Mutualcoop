import { Validation } from "../../submodules/ValidationJS/js/Validation.js";

$('.eventos-slider').not('.slick-initialized').slick({
    autoplay: false,
    speed: 800,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    focusOnSelect: true,
    mobileFirst:true,
    infinite:false,
    responsive: [{
        breakpoint: 1023,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3
    }, }, {
        breakpoint: 767,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
    }, }, ]
});

document.addEventListener('DOMContentLoaded', function(e){
    if(document.querySelector('#consultar')){
        new Validation({
            id: 'consultar',
        },{
            submit: true,
        }, validation.rules, validation.messages);
    }
});