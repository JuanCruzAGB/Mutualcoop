// * Filter repository.
import { Rule } from "./Rule.js";

/**
 * * Filter makes an excellent filter.
 * @export
 * @class Filter
 */
export class Filter{
    /**
     * * Creates an instance of Filter.
     * @param {object} properties - Filter properties.
     * @param {object} states - Filter states.
     * @param {object} data - Data to filter.
     * @memberof Filter
     */
    constructor(properties = {
        id: 'filter-1',
        order: {
            by: undefined,
            type: 'DESC',
        }, limit: false,
    }, states = {},
    rules = [{
        target: undefined,
        comparator: '=',
        value: undefined,
    }], data = []){
        this.setProperties(properties);
        this.setStates(states);
        this.setRules(rules);
        this.setData(data);
    }

    /**
     * * Set the Filter properties.
     * @param {object} properties - Filter properties.
     * @memberof Filter
     */
    setProperties(properties = {
        id: 'filter-1',
        order: {
            by: undefined,
            type: 'DESC',
        }, limit: false,
    }){
        this.properties = {};
        this.setId(properties);
        this.setOrder(properties);
        this.setLimit(properties);
    }

    /**
     * * Set the Filter states.
     * @param {object} states - Filter states.
     * @memberof Filter
     */
    setStates(states = {
        //
    }){
        this.states = {};
    }

    /**
     * * Set the Filter rules.
     * @param {object} rules - Filter rules.
     * @memberof Filter
     */
    setRules(rules = [{
        target: undefined,
        comparator: '=',
        value: undefined,
    }]){
        this.rules = [];
        for(const rule of rules){
            this.rules.push(new Rule(rule, this.properties.id));
        }
    }

    /**
     * * Set the Filter data.
     * @param {object} data - Filter data.
     * @memberof Filter
     */
    setData(data = undefined){
        this.data = data;
    }

    /**
     * * Set the Filter ID.
     * @param {object} properties - Filter properties.
     * @memberof Filter
     */
    setId(properties = {
        id: 'filter-1',
    }){
        this.properties.id = properties.id;
    }

    /**
     * * Set the Filter order.
     * @param {object} properties - Filter properties.
     * @memberof Filter
     */
    setOrder(properties = {
        order: {
            by: undefined,
            type: 'DESC',
        },
    }){
        this.properties.order = {
            by: undefined,
            type: 'DESC'
        };
        if(properties.order.by){
            this.properties.order.by = properties.order.by;
        }
        if(properties.order.type){
            this.properties.order.type = properties.order.type;
        }
    }

    /**
     * * Set the Filter limit.
     * @param {object} properties - Filter properties.
     * @memberof Filter
     */
    setLimit(properties = {
        limit: false,
    }){
        this.properties.limit = properties.limit;
    }

    /**
     * * Prepare the filter function.
     * @returns
     * @memberof Filter
     */
    execute(){
        this.order();
        this.filteredData = [];
        let aux = [];
        this.currentPage = 1;
        if(this.rules.length){
            for(const rule of this.rules){
                aux = rule.check(this.data, this.properties.limit);
                if(aux.length){
                    this.checkData(aux);
                }else{
                    this.filteredData = [];
                    break;
                }
            }
        }else{
            this.filteredData = this.data;
        }
        return this.limit();
    }

    /**
     * * Filter the data.
     * @param {string} type - Type of filtration.
     * @param {object} auxData - Array to push the data filtered.
     * @memberof Filter
     */
    filter(type = '', auxData = []){
        for(const data of this.data){
            if(data.hasOwnProperty(rule.target)){
                let value;
                if(type == 'object'){
                    const element = data[rule.target];
                    for(const iterator of element){
                        if(iterator.hasOwnProperty(rule_key)){
                            value = iterator[rule_key];
                        }
                    }
                }else{
                    value = data[rule.target];
                }
                if(this.checkComparator(rule, rule_value, value)){
                    this.count++;
                    auxData.push(data);
                }
            }
        }
    }

    /**
     * * Order the data.
     * @memberof Filter
     */
    order(){
        switch(this.properties.order.type.toUpperCase()){
            case 'DESC':
                this.orderDesc();
                break;
            case 'ASC':
                this.orderAsc();
                break;
        }
    }

    /**
     * * Order the data ascendly.
     * @memberof Filter
     */
    orderAsc(){
        this.data = this.data.sort(this.orderAscFunction((this.properties.order)));
    }

    /**
     * * Order the data descendly.
     * @memberof Filter
     */
    orderDesc(){
        this.data = this.data.sort(this.orderAscFunction((this.properties.order)));
        this.data = this.data.reverse();
    }

    /**
     * * The order ascending function.
     * @param {object} order - Filter order property.
     * @returns
     * @memberof Filter
     */
    orderAscFunction(order = {
        by: undefined,
    }){
        return function(a, b) {
            if(a.hasOwnProperty(order.by)){
                let aValue = a[order.by],
                    bValue = b[order.by];
                if(typeof aValue == 'string'){
                    aValue = aValue.toUpperCase();
                    bValue = bValue.toUpperCase();
                }
                if(aValue < bValue){
                    return -1;
                }
                if(aValue > bValue){
                    return 1;
                }
    
            }
            return 0;
        }
    }

    /**
     * * Limit the data.
     * @returns
     * @memberof Filter
     */
    limit(){
        let returnData = [];
        let auxData = [];
        let column = 1;
        let count = 1;
        for(const data of this.filteredData){
            if(column <= this.properties.limit || !this.properties.limit){
                auxData.push(data);
                if(count == this.filteredData.length){
                    returnData.push(auxData);
                }
                column++;
                count++;
            }else{
                returnData.push(auxData);
                column = 1;
                auxData = [];
                auxData.push(data);
                column++;
                count++;
            }
            if(!this.properties.limit){
                returnData.push(auxData);
            }
        }
        return returnData[this.currentPage - 1];
    }

    /**
     * * Load the following amount of data.
     * @memberof Filter
     */
    next(){
        if(Math.ceil(this.filteredData.length / this.properties.limit) >= this.currentPage){
            this.currentPage++;
            let thereIsNext = true;
            if(!(Math.ceil(this.filteredData.length / this.properties.limit) >= this.currentPage)){
                thereIsNext = false;
            }
            return {
                thereIsNext: thereIsNext,
                data: this.limit(),
            };
        }else{
            return false;
        }
    }

    /**
     * * Reset the Filter.
     * @returns
     * @memberof Filter
     */
    reset(){
        for(const rule of this.rules){
            rule.reset(this.properties.id);
        }
        return this.execute();
    }

    /**
     * * Change a Rule value.
     * @param {string} name - Button name.
     * @param {*} value - Button value.
     * @memberof Rule
     */
    changeValue(name = undefined, value = undefined){
        for(const rule of this.rules){
            rule.changeValue(name, value);
        }
    }

    /**
     * * Change the Filter data.
     * @param {object} newData - The new Filter data.
     * @memberof Filter
     */
    changeData(newData){
        this.data = newData;
    }

    /**
     * * Change the Filter order.
     * @param {object} properties - Filter properties.
     * @memberof Filter
     */
    changeOrder(order = {
        by: undefined,
        type: 'DESC',
    }){
        this.properties.order = {
            by: undefined,
            type: 'DESC'
        };
        if(order.by){
            this.properties.order.by = order.by;
        }
        if(order.type){
            this.properties.order.type = order.type;
        }
    }

    /**
     * * Check if the data to for and the data filtered previous matches.
     * @param {object} dataToFor - Data to for.
     * @memberof Filter
     */
    checkData(dataToFor = []){
        if(!this.filteredData.length){
            for(const data of dataToFor){
                this.filteredData.push(data);
            }
        }else{
            let aux = this.filteredData;
            this.filteredData = [];
            let push;
            if(dataToFor.length){
                for(const newData of dataToFor){
                    push = false;
                    for(const oldData of aux){
                        if(newData == oldData){
                            push = true;
                        }
                    }
                    if(push){
                        this.filteredData.push(newData);
                    }
                }
            }
        }
    }

    /**
     * * Check what if the Rule type.
     * @param {*} rule
     * @returns
     * @memberof Filter
     */
    checkType(rule){
        let auxData = [];
        switch(typeof rule.value){
            case 'object':
                for(const rule_element of rule.value){
                    for(const rule_key in rule_element){
                        if(rule_element.hasOwnProperty(rule_key)){
                            const rule_value = rule_element[rule_key];
                            for(const data of this.data){
                                if(data.hasOwnProperty(rule.target)){
                                    this.filter('object', auxData);
                                }
                            }
                        }
                    }
                }
                break;
            default:
                this.filter('default', auxData);
                break;
        }
        return auxData;
    }
}