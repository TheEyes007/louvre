import DatePicker from './component/DatePicker.js';
import FormCollectionType from './component/FormCollectionType.js';
import Ticket from './component/Ticket.js';
import TicketsContentHTML from './component/TicketsContentHTML.js';
import Validator from './component/Validator.js';
import Init from './component/Init.js';
import PriceCalculator from './component/PriceCalculator.js';

(function($){
  $(function(){

      // CONSTRUCTION DU TABLEAU D'OBJET DES TICKETS

      var tickets = [];

      // INITIALISATION DES DATES PICKINS ET DU CALENDRIER

      var startDate = new DatePicker(new Date()).dateBeforeFifty();
      var dateofbirthoptions = new Init().dateofbirthOption();
      var dateofbirthOptionAdult = new Init().dateofbirthOptionAdult();
      var dateofbookingoptions = new Init().dateofbookingOption();

      $('.datepicker').datepicker(dateofbirthOptionAdult);
      $('.datepicker').datepicker("setDate",new Date(startDate.month + '/' + startDate.day + '/' + startDate.year));
      $('.datepicker-booking').datepicker(dateofbookingoptions);
      $('.sidenav').sidenav();
      $('.parallax').parallax();
      $('select').formSelect();
      $('.modal').modal({dismissible: false});


      // AJOUTER UN FORMULAIRE

      $('#add-tickets').click(function(){
          $('#collection_tickets_tickets').css('display','none');
          new FormCollectionType().createForm($('#tickets-id-form'), tickets);

          $('select').formSelect();
          $('.datepicker').datepicker(dateofbirthoptions);
          $('.datepicker').datepicker("setDate",new Date(startDate.month + '/' + startDate.day + '/' + startDate.year));
          $('.datepicker-booking').datepicker(dateofbookingoptions);
      });

      $('#validate-form').click(function(){

          // CREATION DU TICKETS
          var ticket = new Ticket(
              $('#collection_tickets_tickets_'+tickets.length+'_name').val(),
              $('#collection_tickets_tickets_'+tickets.length+'_firstname').val(),
              $('#collection_tickets_tickets_'+tickets.length+'_dateofbirth').val(),
              $('#collection_tickets_tickets_'+tickets.length+'_tarif').val(),
              $('#collection_tickets_tickets_'+tickets.length+'_dateofbooking').val(),
              $('#collection_tickets_tickets_'+tickets.length+'_country > option:selected').text()
          );

          var validatorTickets = new Validator(ticket);
          var notNullValidator = validatorTickets.notnullValidator();

          if(notNullValidator.length === 0){
              if(validatorTickets.notdateValidator(ticket.dateofbirth) === false && validatorTickets.notdateValidator(ticket.dateofbooking) === false){
                  M.toast({html: 'Le format des dates de naissance et de réservation sont invalides, merci de saisir les formats dd/mm/yyyy'}, 12000);
              }else if(validatorTickets.notdateValidator(ticket.dateofbirth) === false){
                  M.toast({html: 'Le format de la date de naissance est invalide, merci de saisir le format dd/mm/yyyy'}, 12000);
              }else if (validatorTickets.notdateValidator(ticket.dateofbooking) === false) {
                  M.toast({html: 'Le format de la date de réservation est invalide, merci de saisir le format dd/mm/yyyy'}, 12000);
              }else if(new DatePicker(ticket.dateofbooking).checkdateforToday() === false){
                  M.toast({html: 'Vous ne pouvez pas réserver à une date antérieure à la date du jour'}, 12000);
              }else if(new DatePicker(ticket.dateofbirth).checkdateforBirthday() === false){
                  M.toast({html: 'La date de naissance doit être inférieure à la date du jour'}, 12000);
              }else if(new DatePicker(ticket.dateofbooking).checkdateNofreeday() === false){
                  M.toast({html: 'Vous ne pouvez pas réserver un jour férié'}, 12000);
              }else if(ticket.getTarif() === 'Invalide'){
                  M.toast({html: 'Le tarif est invalide'}, 12000);
              }else{
                  $('.tickets-alert').css('display','none');
                  M.toast({html: 'Votre formulaire a été validé'}, 12000);
                  ticket.tarif = ticket.getTarif();
                  ticket.price = ticket.getPrice();
                  new FormCollectionType().stockForm('#collection_tickets_tickets_%var%', tickets);
                  tickets.push(ticket);
                  new TicketsContentHTML().contentInsert(tickets);
                  $('.modal').modal('close');

                  new PriceCalculator().calculTickets(tickets,'.nb-tickets-content');
                  new PriceCalculator().calculPrice(tickets.length, tickets, '.price-tickets-content');
              }
          }else if (notNullValidator.length === 4) {
              M.toast({html: 'Veuillez renseigner l\'ensemble des champs du formulaire'}, 12000);
          }else{
              for(var x=0; x<notNullValidator.length; x++){
                  M.toast({html: 'Veuillez renseigner le champ '+ notNullValidator[x] +' du formulaire.'}, 12000);
              }
          }

      });

      $('#close-form').click(function() {
           new FormCollectionType().deleteForm('#collection_tickets_tickets_%var%', tickets);
          $('.modal').modal('close');
          new PriceCalculator().calculTickets(tickets,'.nb-tickets-content');
          new PriceCalculator().calculPrice(price_tickets, tickets.lenght, tickets);
      });

      $('.lists-tickets').on('click', '.delete-button-ticket' ,function() {
            let id = $(this).attr('id');
            let indexId = id.replace('delete-item-','');
            $('.ticket-one-'+indexId).remove();
            $('#collection_tickets_tickets_'+indexId).remove();
            tickets.splice(indexId,1);

            if(tickets.length === 0){
                $('.tickets-alert').css('display','block');
            }

          new PriceCalculator().calculTickets(tickets,'.nb-tickets-content');
          new PriceCalculator().calculPrice(tickets.length, tickets, '.price-tickets-content');

          M.toast({html: 'Le ticket n°'+indexId+' a été supprimé'}, 12000);
      });


      $('.modal-overlay').click(function() {
          new FormCollectionType().deleteForm('#collection_tickets_tickets_%var%', tickets);
          $('.modal').modal('close');
      });


  }); // end of document ready
})(jQuery); // end of jQuery name space