/**
 * * URL controls the url correctly.
 * @export
 * @class URL
 */
export class URL{
    /**
     * * Returns the url #hash.
     * @static
     * @returns
     * @memberof URL
     */
    static findHashParameter(){
        return window.location.href.split('#').pop().split('?').shift();
    }

    /**
     * * Returns an specific url parameter.
     * @static
     * @param {*} parameterName
     * @returns
     * @memberof URL
     */
    static findGetParameter(parameterName){
        var result = false;
        let parameters = window.location.href.split('?').pop().split('&');
        let auxParams = []
        for(let param of parameters){
            auxParams.push({key: param.split('=').shift(), value: param.split('=').pop()});
            if(param.split('=').shift() == parameterName){
                result = param.split('=').pop();
            }
        }
        if(parameterName){
            return result;
        }else{
            return auxParams;
        }
    }

    /**
     * * Returns the route without the #hash.
     * @static
     * @memberof URL
     */
    static findOriginalRoute(){
        return window.location.pathname;
    }
}