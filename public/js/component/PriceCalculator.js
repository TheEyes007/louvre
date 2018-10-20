'use strict';

export default class PriceCalculator{

    calculTickets(tickets,className){
        if (tickets.length === 1) {
            $(className).text('1 ticket');
        } else if (tickets.length === 0) {
            $(className).text('Aucun ticket commandé');
        } else if (tickets.length > 1) {
            $(className).text(tickets.length + ' tickets');
        }
    }

    calculPrice(nbtickets, tickets,className){
        let price_tickets = 0;

        for (let i = 0; i < nbtickets; i++) {
            price_tickets = price_tickets + tickets[i].price;
        }

        $(className).text(price_tickets + ' €');
    }
}
