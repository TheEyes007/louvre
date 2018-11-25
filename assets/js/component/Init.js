import DatePicker from './DatePicker.js';

'use strict';

export default class Init {
    dateofbirthOptionAdult(){
        let startDate = new DatePicker(new Date()).dateBeforeFifty();
        let dateM = new DatePicker(new Date()).dateMajority();

        var option =
            {
                format: 'dd/mm/yyyy',
                maxDate: new Date(dateM.month + '/' + dateM.day + '/' + dateM.year),
                yearRange:50,
                setDefaultDate: true,
                firstDay: 1,
                showClearBtn: true,
                i18n: {
                    cancel: 'Annuler',
                    clear: 'Supprimer',
                    done: 'Valider',
                    showClearBtn: true,
                    firstDay: 1,
                    months: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
                    monthsShort: ['Jan','Fev','Mar','Avr','Mai','Juin','Juil','Aout','Sept','Oct','Nov','Dec'],
                    weekdays: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                    weekdaysShort:['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                    weekdaysAbbrev: ['D','L','Ma','Me','J','V','S']
                }
            };

        return option;
    }

    dateofbirthOption(){
        let startDate = new DatePicker(new Date()).dateBeforeFifty();

        var option =
            {
                format: 'dd/mm/yyyy',
                yearRange:50,
                setDefaultDate: true,
                firstDay: 1,
                showClearBtn: true,
                i18n: {
                    cancel: 'Annuler',
                    clear: 'Supprimer',
                    done: 'Valider',
                    showClearBtn: true,
                    firstDay: 1,
                    months: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
                    monthsShort: ['Jan','Fev','Mar','Avr','Mai','Juin','Juil','Aout','Sept','Oct','Nov','Dec'],
                    weekdays: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                    weekdaysShort:['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                    weekdaysAbbrev: ['D','L','Ma','Me','J','V','S']
                }
            };

        return option;
    }

    dateofbookingOption(){
        let startDate = new DatePicker(new Date()).dateBeforeFifty();
        let dateM = new DatePicker(new Date()).dateMajority();

        var option =
            {
                format: 'dd/mm/yyyy',
                minDate: new Date(),
                maxDate: new Date(new Date().getFullYear() + 1,11,31),
                yearRange:50,
                setDefaultDate: true,
                firstDay: 1,
                showClearBtn: true,
                disableDayFn:function(date) {
                    if(date.getDay() == 0 || date.getDay() == 2) {
                        return true;
                    }
                        return false;
                },
                onDraw: function() {
                    for(var i = new Date().getFullYear(); i < new Date().getFullYear()+2; i++)
                    {
                        let Year = i;
                        let Month = new Date().getMonth();
                        let day = new Date().getDate();
                        let date = new Date(Year,Month,day);
                        var dayfree = new DatePicker(date).freeday(date.getFullYear());

                        for(var j = 0; j < dayfree.length; j++){
                            var yearSelector = '[data-year="' + dayfree[j].getFullYear() + '"]';
                            var monthSelector = '[data-month="' + dayfree[j].getMonth() + '"]';
                            var daySelector = '[data-day="' + dayfree[j].getDate() + '"]';
                            $(yearSelector + monthSelector + daySelector).parent().addClass('is-disabled');
                        }
                    }
                },
                i18n: {
                    cancel: 'Annuler',
                    clear: 'Supprimer',
                    showClearBtn: true,
                    firstDay: 1,
                    months: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
                    monthsShort: ['Jan','Fev','Mar','Avr','Mai','Juin','Juil','Aout','Sept','Oct','Nov','Dec'],
                    weekdays: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                    weekdaysShort:['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                    weekdaysAbbrev: ['D','L','Ma','Me','J','V','S']
                }
            };

        return option;
    }
}