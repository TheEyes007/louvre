'use strict';

export default class FormCollectionType{
    createForm(formId,tickets){

        // DEFINIR IDENTIFIANT DU FORMULAIRE A PARTIR DU NOMBRE DEJA CREE
        let countTickets = tickets.length;

        // STOCKAGE DU FORMULAIRE PROTOTYPE EN VARIABLE AVEC CREATION IDENTIFIANT
        var formContain = $(formId).data('prototype');
        formContain = formContain.replace(/__name__/g, countTickets);

        //CREATION DU FORMULAIRE
        $(formId).append(formContain);
    }

    deleteForm(formId, tickets){

        // DEFINIR IDENTIFIANT DU FORMULAIRE A PARTIR DU NOMBRE DEJA CREE
        let countTickets = tickets.length;

        //SUPPRIMER LE FORMULAIRE
        let idForm = formId;
        idForm = idForm.replace(/%var%/,countTickets);
        $(idForm).remove();
    }

    stockForm(formId, tickets){

        // DEFINIR IDENTIFIANT DU FORMULAIRE A PARTIR DU NOMBRE DEJA CREE
        let countTickets = tickets.length;

        //SUPPRIMER LE FORMULAIRE
        let idForm = formId;
        idForm = idForm.replace(/%var%/,countTickets);
        $(idForm).appendTo('#collection_tickets_tickets');
    }
}