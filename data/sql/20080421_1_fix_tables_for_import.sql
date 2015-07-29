# modifica le tabelle, preparandole per l'import dei dati

# aggiunta colonna per memorizzare il nome del Ministero Interni (in caso sia errato)
# questo campo viene riempito da una callback, in occasione della modifica di 
# uno tra i campi: first_name, last_name o birth_date di op_politician
alter table op_politician add column minint_aka varchar(255);
alter table op_politician add unique index op_politician_minint_aka_idx (minint_aka);

# aggiunta colonna che mostra la data di importazione dal minint
# serve per la chiusura degli incarichi non più presenti nei file minint
alter table op_institution_charge add column minint_verified_at datetime;

