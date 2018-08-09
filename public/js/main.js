function dateBeforeFifty(){
    var startDate;
    var yearStart = new Date().getFullYear() - 50;
    if(new Date().getDate() < 10)
    {
        var dayStart = '0' + new Date().getDate()
    }else{
        var dayStart = new Date().getDate();
    }
    if(new Date().getMonth() < 9)
    {
        var monthStart = new Date().getMonth() + 1;
        monthStart = '0' + monthStart;
    }else{
        var monthStart = new Date().getMonth() + 1;
    }

    startDate = {day: dayStart, month: monthStart, year: yearStart};

    return startDate;;
}

function dateMajority(){
    var dateM;
    var yearStart = new Date().getFullYear() - 18;
    if(new Date().getDate() < 10)
    {
        var dayStart = '0' + new Date().getDate()
    }else{
        var dayStart = new Date().getDate();
    }
    if(new Date().getMonth() < 9)
    {
        var monthStart = new Date().getMonth() + 1;
        monthStart = '0' + monthStart;
    }else{
        var monthStart = new Date().getMonth() + 1;
    }

    dateM = {day: dayStart, month: monthStart, year: yearStart};

    return dateM;
}
var startDate = dateBeforeFifty();
var dateM = dateMajority();

const options = {
    format: 'dd/mm/yyyy',
    maxDate: new Date(dateM.month + '/' + dateM.day + '/' + dateM.year),
    yearRange:50,
    setDefaultDate: true,
    firstDay: 1,
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

(function($){
  $(function(){
      $('.datepicker').datepicker(options);
      $('.datepicker').datepicker("setDate",new Date(startDate.month + '/' + startDate.day + '/' + startDate.year));
    $('.sidenav').sidenav();
    $('.parallax').parallax();
  }); // end of document ready
})(jQuery); // end of jQuery name space