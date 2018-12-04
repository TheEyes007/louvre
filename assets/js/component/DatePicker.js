'use strict';

export default class DatePicker{

    constructor(date){
        this.date = date;
    }

    formatDate(date){
        var year = new Date(date).getFullYear();

        if(new Date(date).getDate() < 10)
        {
            var day = '0' + new Date(date).getDate()
        }else{
            var day = new Date(date).getDate();
        }

        if(new Date(date).getMonth() < 9)
        {
            var month = new Date(date).getMonth() + 1;
            month = '0' + month;
        }else{
            var month = new Date(date).getMonth() + 1;
        }

        date = day + '/' + month + '/' + year;

        return date;
    }

    dateBeforeFifty(){
        let date = this.date;
        var startDate;
        let yearStart, dayStart,monthStart;
        yearStart = new Date().getFullYear() - 50;
        if(new Date().getDate() < 10)
        {
            dayStart = '0' + new Date().getDate()
        }else{
            dayStart = new Date().getDate();
        }
        if(new Date().getMonth() < 9)
        {
            monthStart = new Date().getMonth() + 1;
            monthStart = '0' + monthStart;
        }else{
            let monthStart = new Date().getMonth() + 1;
        }

        startDate = {day: dayStart, month: monthStart, year: yearStart};

        return startDate;
    }

    freeday (an){
        //let JourAn = new Date(an, "00", "01");
        let FeteTravail = new Date(an, "04", "01");
        //let Victoire1945 = new Date(an, "04", "08");
        //let FeteNationale = new Date(an,"06", "14");
        //let Assomption = new Date(an, "07", "15");
        let Toussaint = new Date(an, "10", "01");
        //let Armistice = new Date(an, "10", "11");
        let Noel = new Date(an, "11", "25");

        /*
        let G = an%19;
        let C = Math.floor(an/100);
        let H = (C - Math.floor(C/4) - Math.floor((8*C+13)/25) + 19*G + 15)%30;
        let I = H - Math.floor(H/28)*(1 - Math.floor(H/28)*Math.floor(29/(H + 1))*Math.floor((21 - G)/11));
        let J = (an*1 + Math.floor(an/4) + I + 2 - C + Math.floor(C/4))%7;
        let L = I - J;
        let MoisPaques = 3 + Math.floor((L + 40)/44);
        let JourPaques = L + 28 - 31*Math.floor(MoisPaques/4);
        let Paques = new Date(an, MoisPaques-1, JourPaques);
        let LundiPaques = new Date(an, MoisPaques-1, JourPaques+1);
        let Ascension = new Date(an, MoisPaques-1, JourPaques+39);
        let Pentecote = new Date(an, MoisPaques-1, JourPaques+49);
        let LundiPentecote = new Date(an, MoisPaques-1, JourPaques+50);
        */


        return new Array(FeteTravail, Toussaint, Noel)
    }

    checkdateforToday() {
        let dateofbooking = this.date;
        let year, month, day;
        year = new Date().getFullYear();
        month = new Date().getMonth() + 1;
        day = new Date().getDate();
        let yearB = parseInt(dateofbooking.substring(6, 10));
        let monthB = parseInt(dateofbooking.substring(3, 5));
        let dayB = parseInt(dateofbooking.substring(0, 2));

        if (year > yearB) {
            return false;
        }
        else if (year === yearB) {
            if (month > monthB) {
                return false;
            }else if (month === monthB) {
                if (day > dayB) {
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    checkdateforBirthday() {
        let dateofbirth = this.date;
        let year, month, day;
        year = new Date().getFullYear();
        month = new Date().getMonth() + 1;
        day = new Date().getDate();
        let yearBirth = parseInt(dateofbirth.substring(6, 10));
        let monthBirth = parseInt(dateofbirth.substring(3, 5));
        let dayBirth = parseInt(dateofbirth.substring(0, 2));

        if (year < yearBirth) {
            return false;
        }
        else if (year === yearBirth) {
            if (month < monthBirth) {
                return false;
            }else if (month === monthBirth) {
                if (day < dayBirth) {
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    checkdateNofreeday(){
        let dateofbooking = this.date;
        let yearB = parseInt(dateofbooking.substring(6, 10));
        let dayfree = this.freeday(yearB);
        let dayfreeDate = new Date(dayfree[0]);

        let countTrue = 0;

        for(let i=0;i<dayfree.length;i++){
            if(dateofbooking === this.formatDate(dayfree[i]))
            {
                countTrue = countTrue + 1;
            }
        }
        if (countTrue === 0){
            return true;
        }else{
            return false;
        }
    }

    dateMajority(){
        var dateM;
        let dayStart, monthStart, yearStart;
        yearStart = new Date().getFullYear() - 18;
        if(new Date().getDate() < 10)
        {
             dayStart = '0' + new Date().getDate()
        }else{
             dayStart = new Date().getDate();
        }
        if(new Date().getMonth() < 9)
        {
            monthStart = new Date().getMonth() + 1;
            monthStart = '0' + monthStart;
        }else{
            monthStart = new Date().getMonth() + 1;
        }

        dateM = {day: dayStart, month: monthStart, year: yearStart};

        return dateM;
    }

    getAge(){
        var today = new Date();
        var dateofbirth = this.date;
        var dateofbirth = dateofbirth.substring(3,5) + '/' + dateofbirth.substring(0,2) + '/' + dateofbirth.substring(6,10);

        var dateofbirth = new Date(dateofbirth);
        var age = today.getFullYear() - dateofbirth.getFullYear();
        var m = today.getMonth() - dateofbirth.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dateofbirth.getDate())) {
            age--;
        }
        return age;
    }
}
