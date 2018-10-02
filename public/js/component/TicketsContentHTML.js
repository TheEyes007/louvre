'use strict';

export default class TicketsContentHTML{

    constructor(content){
        this.content = content;
    }

    contentGenerate(){
        var content = this.content;
        content =
            '<div class="col s12 m3 ticket-one-%var%">' +
            '<div class="card">' +
            '<div><h6 class="center-align">Ticket</h6></div><hr/>' +
            '<div class="card-image">' +
            '<img class="tickets-img" src="/img/tickets.png">' +
            '</div>'+
            '<div class="card-content">'+
            '<p class="tickets-text">Nom du visiteur : <b id="name-visiteur-%var%">__name_content__</b></p>'+
            '<p class="tickets-text">Prénom du visiteur : <b id="firstname-visiteur-%var%">__firstname_content__</b></p>' +
            '<p class="tickets-text">Date de naissance : <b id="date-of-birth-visiteur-content-%var%">__dateofbirth_content__</b></p>' +
            '<p class="tickets-text">Pays : <b id="pays-visiteur-content-%var%">__pays_content__</b></p>' +
            '<p class="tickets-text">Date de réservation : <b id="dateofbooking-visiteur-content-%var%">__dateofbooking_content__</b></p>' +
            '<p class="tickets-text">Tarif : <b id="tarif-visiteur-content-%var%">__tarif_content__</b></p>' +
            '<p class="tickets-text">Prix de : <b id="price-content-%var%"></b>__price_content__ €</p>' +
            '</div>'+
            '<div class="card-action tickets-button">' +
            '<button id="delete-item-%var%" class="delete-button-ticket btn-floating waves-effect waves-light red center" type="button"><i class="material-icons">remove</i></button>' +
            '</div>'+
            '</div>'+
            '</div>';

        return content;
    }

    contentInsert(tickets){

        let index = tickets.length - 1;
        let content = this.contentGenerate();

        content = content.replace(/%var%/g, index);

        content = content.replace('__name_content__',tickets[index].name);
        content = content.replace('__firstname_content__',tickets[index].firstname);
        content = content.replace('__dateofbirth_content__',tickets[index].dateofbirth);
        content = content.replace('__age_content__',tickets[index].age);
        content = content.replace('__pays_content__',tickets[index].country);
        content = content.replace('__dateofbooking_content__',tickets[index].dateofbooking);
        content = content.replace('__tarif_content__',tickets[index].tarif);
        content = content.replace('__price_content__',tickets[index].price);

        $('.lists-tickets').append(content);
    }
}