'use strict';

import DatePicker from './DatePicker.js';

export default class Ticket{
    constructor(name,firstname,dateofbirth,tarif,dateofbooking,country){
        this.name = name;
        this.firstname = firstname;
        this.dateofbirth = dateofbirth;
        this.tarif = tarif;
        this.dateofbooking = dateofbooking;
        this.country = country;
    }

    getTarif(){
        let age = new DatePicker(this.dateofbirth).getAge();
        var tarif = this.tarif;

        if (age < 4){
            tarif = 'Gratuit';
        }else if (age > 3 && age < 12){
            tarif = 'Enfant';
        }else if (age > 11 && age < 60){
            tarif = 'Normal';
        }else if (age > 59 && age < 106){
            tarif = 'Senior';
        }else if (this.tarif = 'Tarif Réduit'){
            tarif = 'Tarif Réduit';
        }else if (this.tarif = 'Demi-journée'){
            tarif = 'Demi-journée';
        }else{
            tarif = 'Invalide';
        }

        return tarif;
    }

    getPrice(){
        let tarif = this.getTarif();
        var price;

        switch (tarif) {
            case 'Normal':
                price = 16;
                break;
            case 'Enfant':
                price = 8;
                break;
            case 'Senior':
                price = 12;
                break;
            case 'Réduit':
                price = 10;
                break;
            case 'Demi-Journée':
                price = 8;
                break;
            case 'Gratuit':
                price = 0;
                break;
            default:
                price = 'Invalide';
                break;
        }
        return price;
    }
}