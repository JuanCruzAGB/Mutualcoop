// * External repositories
import { Dropdown as DropdownJS } from '../../submodules/DropdownJS/js/Dropdown.js';
import { NavMenu as NavMenuJS } from '../../submodules/NavMenuJS/js/NavMenu.js';
import { Notification as NotificationJS } from '../../submodules/NotificationJS/js/Notification.js';
import { Sidebar as SidebarJS } from '../../submodules/SidebarJS/js/Sidebar.js';
import { TabMenu as TabMenuJS } from '../../submodules/TabMenuJS/js/TabMenu.js';
import { URLServiceProvider as URL } from "../../submodules/ProvidersJS/URLServiceProvider.js";

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

    if(document.querySelector('#tab')){
        let sidebar_tab = new SidebarJS({
            id: 'tab',
            position: 'left',
        });

        let tabmenu = new TabMenuJS({
            id: 'tab',
        }, {
            open: [document.querySelector('.tab-content').id],
            active: URL.findOriginalRoute(),
        });
    }

    if(document.querySelector('#filters')){
        let sidebar_filters = new SidebarJS({
            id: 'filters',
            position: 'right',
        });
    }

    let notifications = []
    if(suscriptions){
        for(const suscription of suscriptions){
            notifications.push(new NotificationJS({
                id: suscription.id,
                code: 300,
                message: suscription.message,
                url: suscription.url,
                method: suscription.method,
            }, {show: true}, {
                element: document.querySelector('.main > div'),
                insertBefore: document.querySelector('.main > div').children[0]
            }));
        }
    }

    let dropdowns = [];
    let dropdowns_html = document.querySelectorAll('.dropdown');
    for(const html of dropdowns_html){
        let booleanOpen = false;
        for(const child of html.children){
            if(child.classList.contains('dropdown-menu-list')){
                for(const li of child.children){
                    if(li.tagName == 'LI'){
                        if(window.location.href == li.children[0].href && li.classList.contains('tab')){
                            booleanOpen = true;
                        }else if(li.children.length > 1 && li.classList.contains('tab')){
                            for(const subli of li.children[1].children){
                                if(window.location.href == subli.children[0].href){
                                    booleanOpen = true;
                                }
                            }
                        }
                    }
                }
            }
        }
        dropdowns.push(new DropdownJS({
            id: html.id,
        }, {
            open: booleanOpen,
        }));
    }

    if(status){
        notifications.push(new NotificationJS({
            id: 'notification-1',
            code: status.code,
            message: status.message,
        }, {show: true}, {
            element: document.querySelector('.main > div'),
            insertBefore: document.querySelector('.main > div').children[0]
        }));
    }
});