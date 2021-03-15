// $(document).ready(function() {
//     function cerrarAccordion() {
//         $('.accordion .accordion-div-title').removeClass('active');
//         $('.accordion .accordion-div-content').slideUp(300).removeClass('open');
//     }

//     $('.accordion-div-title').click(function(e) {

//         var valorActual = $(this).attr('href');

//         if($(e.target).is('.active')) {
//             cerrarAccordion();
//         }else {
//             cerrarAccordion();

//             // Agrego la class active
//             $(this).addClass('active');
//             // abro el contenido
//             $('.accordion ' + valorActual).slideDown(300).addClass('open');
//         }

//         e.preventDefault();
//     });
// });
