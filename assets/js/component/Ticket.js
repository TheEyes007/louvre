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

        if (tarif === 'Tarif Normal') {
            if (age < 4) {
                tarif = 'Tarif Gratuit';
            } else if (age > 3 && age < 12) {
                tarif = 'Tarif Enfant';
            } else if (age > 11 && age < 60) {
                tarif = 'Tarif Normal';
            } else if (age > 59 && age < 106) {
                tarif = 'Tarif Senior';
            }
        }

        if (this.tarif === 'Tarif Réduit') {
            tarif = 'Tarif Réduit';
        }

        if (this.tarif === 'Tarif Demi-Journée') {
            tarif = 'Tarif Demi-journée';
        }

        if (this.tarif === 'Invalide') {
            tarif = 'Invalide';
        }

        return tarif;
    }

    getPrice(){
        let tarif = this.getTarif();
        var price;

        switch (tarif) {
            case 'Tarif Normal':
                price = 16;
                break;
            case 'Tarif Enfant':
                price = 8;
                break;
            case 'Tarif Senior':
                price = 12;
                break;
            case 'Tarif Réduit':
                price = 10;
                break;
            case 'Tarif Demi-journée':
                price = 8;
                break;
            case 'Tarif Gratuit':
                price = 0;
                break;
            default:
                price = 'Invalide';
                break;
        }
        return price;
    }
}