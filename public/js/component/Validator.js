'use strict';

import DatePicker from './DatePicker.js';

export default class Validator {

    constructor(boxValidator) {
        this.boxValidator = boxValidator;
    }

    notnullValidator() {
        var object = this.boxValidator;
        var property, fieldEmpty = [];


        for (property in object) {
            if (object[property] === '') {
                fieldEmpty.push(property);
            }
        }

        return fieldEmpty;
    }

    notdateValidator(dateField){
        var dateControl = new DatePicker(dateField).getAge();
        if(isNaN(dateControl)){
            return false;
        }else{
            return true;
        }
    }
}