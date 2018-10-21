Le dossier Entity contient deux classes : 
- La classe command qui contient les informations de l'acheteur<br>
   
   - Id (primary key)
   - Name
   - Firname
   - Dateofbirth
   - Email
   - Status
   - Price
   - Command_number
   
- La classe tickets qui contient la liste des tickets achetés et validés<br>

    - Id (primary key)
    - Command_id (foreign key)
    - Name
    - Firstname
    - Dateofbirth
    - Ticket
    - Dateofbooking