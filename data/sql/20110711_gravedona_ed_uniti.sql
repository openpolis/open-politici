-- i comuni di Gravedona, Germasino e Consiglio di Rumo si fondono nel comune
-- di Gravedona ed Uniti
insert into op_location values (NULL, 6, 'Gravedona ed Uniti', 1, 3, 13, 13249, 'CO', 4222, '2011-07-11 11:47:00', NULL, 3, 24, 1055, '2011-02-11', NULL, NULL, NULL, NULL);
update op_location set date_end='2011-02-11', new_location_id=LAST_INSERT_ID() where id in (1699, 1680, 1703);

-- il sindaco era stato assegnato per sbaglio al comune di gravedona
update op_institution_charge set location_id=LAST_INSERT_ID() where location_id=1703 and date_end is null;
  
-- l'alternative_name 'gravedona ed uniti' è rimosso per eliminare eventuali errori nell'import
update op_location set alternative_name=NULL where id=1703;