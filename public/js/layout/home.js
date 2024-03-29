// ? External repositories
import { NavMenu as NavMenuJS } from '../../submodules/NavMenuJS/js/NavMenu.js';
import { Dropdown as DropdownJS } from '../../submodules/DropdownJS/js/Dropdown.js';
import { ScrollDetection as ScrollDetectionJS } from '../../submodules/ScrollDetectionJS/js/ScrollDetection.js';
import { URLServiceProvider as URL } from "../../submodules/ProvidersJS/URLServiceProvider.js";

function bigHeader(params) {
    let navRow = document.querySelector('.nav-menu .nav-row:first-child');
    navRow.classList.add('big');
}

function commonHeader(params) {
    let navRow = document.querySelector('.nav-menu .nav-row:first-child');
    navRow.classList.remove('big');
}

document.addEventListener('DOMContentLoaded', (e) => {
    let navmenu = new NavMenuJS({
        id: 'nav-1',
        sidebar: {
            id: ['menu'],
            position: ['left'],
        }, dropdown:{
            //
        },
    }, {
        fixed: true,
        hideOnScrollDown: true,
        current: URL.findCompleteRoute(),
    });

    let dropdowns = [];
    let dropdowns_html = document.querySelectorAll('.dropdown');
    for(const html of dropdowns_html){
        dropdowns.push(new DropdownJS({
            id: html.id,
        }, {
            open: false,
        }));
    }

    if (URL.findOriginalRoute() == '/') {
        let scrolldetection = new ScrollDetectionJS({
            location: {
                min: 0,
                max: 160,
            }, direction: {
                scrollbar: 'Y',
        }}, {
            success: {
                function: bigHeader,
                params: [],
            }, error: {
                function: commonHeader,
                params: [],
            }
        });
    }
});