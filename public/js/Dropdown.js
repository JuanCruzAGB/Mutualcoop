/**
 * * Dropdown control the dropdowns buttons.
 * @export
 * @class Dropdown
 */
export class Dropdown{
    /**
     * * Creates an instance of Dropdown.
     * @param {object} properties - The Dropdown properties.
     * @memberof Dropdown
     */
    constructor(properties = {html: null, btn: null, menu: null, open: null}){
        this.setName(properties);
        this.setHTML(properties);
        this.setBtn(properties);
        this.setMenu(properties);

        let dropdown = this;
        this.btn.addEventListener('click', function(e){
            e.preventDefault();
            Dropdown.switch(dropdown);
        });

        this.open(properties);
    }

    /**
     * * Set the name.
     * @param {object} properties - The Dropdown properties.
     * @memberof Dropdown
     */
    setName(properties = {html: null}){
        this.name = properties.html.dataset.name;
    }

    /**
     * * Set the html.
     * @param {object} properties - The Dropdown properties.
     * @memberof Dropdown
     */
    setHTML(properties = {html: null}){
        this.html = properties.html;
    }

    /**
     * * Set the btn.
     * @param {object} properties - The Dropdown properties.
     * @memberof Dropdown
     */
    setBtn(properties = {btn: null}){
        this.btn = properties.btn;
    }

    /**
     * * Set the menu.
     * @param {object} properties - The Dropdown properties.
     * @memberof Dropdown
     */
    setMenu(properties = {menu: null}){
        this.menu = properties.menu;
    }

    /**
     * * Open the current Dropdown.
     * @param {object} properties - The Dropdown properties.
     * @memberof Dropdown
     */
    open(properties = {open: null}){
        let selected = null,
            dropdown = this;
        for(const html of document.querySelectorAll('.dropdown-js')){
            if(properties.open == html.name){
                selected = html;
            }else{
                for(const child of html.children[1].children){
                    if(properties.open == child.dataset.name){
                        selected = html;
                    }
                }
            }
        }
        if(this.html == selected){
            Dropdown.switch(dropdown);
        }
    }

    /**
     * * Switch the Dropdown state.
     * @static
     * @param {Dropdown} dropdown - The Dropdown.
     * @memberof Dropdown
     */
    static switch(dropdown){
        if(!dropdown.html.classList.contains('opened')){
            dropdown.html.classList.remove('closed');
            dropdown.html.classList.add('opened');
            dropdown.btn.children[0].classList.remove('fa-sort-down');
            dropdown.btn.children[0].classList.add('fa-sort-up');
        }else{
            dropdown.html.classList.remove('opened');
            dropdown.html.classList.add('closed');
            dropdown.btn.children[0].classList.add('fa-sort-down');
            dropdown.btn.children[0].classList.remove('fa-sort-up');
        }
    }
}