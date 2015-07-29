# aggiunta dei codici ministero interno alle location
alter table op_location add column minint_regional_code integer unsigned;
alter table op_location add index op_location_minint_regional_idx (minint_regional_code);

alter table op_location add column minint_provincial_code integer unsigned;
alter table op_location add index op_location_minint_provincial_idx (minint_provincial_code);

alter table op_location add column minint_city_code integer unsigned;
alter table op_location add index op_location_minint_city_idx (minint_city_code);

# la provincia di Val D'Aosta è conosciuta come AOSTA presso il minint 
update op_location set alternative_name='aosta' where name="Valle D'Aosta" and location_type_id=5;
# i codici regionali e provinciali minint devono essere inseriti manualmente per la val d'aosta
update op_location set minint_regional_code=2, minint_provincial_code=4 where regional_id=2; 
    
# le nuove province in via di istituzione
insert into op_location values (null, 5, 'Monza e della Brianza', 3, 108, null, 'MB', 0, null, null, null, null, null);
insert into op_location values (null, 5, 'Fermo', 11, 109, null, 'FM', 0, null, null, null, null, null);
insert into op_location values (null, 5, 'Barletta-Andria-Trani', 16, 110, null, 'BT', 0, null, null, null, null, null);

# i comuni mancanti (nomi doppi non inseriti per problemi nell'algoritmo)
insert into op_location values (null, 6, 'Samone',      1, 1,   1235,  'TO', 1524, null, null, null, null, null);
insert into op_location values (null, 6, 'Calliano',    1, 5,   5014,  'AT', 1430, null, null, null, null, null);
insert into op_location values (null, 6, 'Castro',      3, 16,  16065, 'BG', 1441, null, null, null, null, null);
insert into op_location values (null, 6, 'Brione',      3, 17,  17030, 'BS',  628, null, null, null, null, null);
insert into op_location values (null, 6, 'Livo',        3, 13,  13130, 'CO',  209, null, null, null, null, null);
insert into op_location values (null, 6, 'Peglio',      3, 13,  13178, 'CO',  209, null, null, null, null, null);
insert into op_location values (null, 6, 'Valverde',    3, 18,  18170, 'PV',  324, null, null, null, null, null);
insert into op_location values (null, 6, 'San Teodoro', 19, 83, 83090, 'ME', 1516, null, null, null, null, null);
  
# inserimento nomi alternativi
update op_location set alternative_name='ABRUZZI' where name='Abruzzo' and location_type_id=4;
  
update op_location set alternative_name='CERRETO LANGHE' where name='Cerretto Langhe' and prov='CN';

update op_location set alternative_name='MONGUELFO-TESIDO' where name like 'Monguelfo%' and prov='BZ';

update op_location set alternative_name="RUFFRE'-MENDOLA" where name like 'Ruffr%' and prov='TN';

update op_location set alternative_name='RONCEGNO' where name like 'Roncegno%' and prov='TN';

update op_location set alternative_name='REANA DEL ROIALE' where name like 'Reana%' and prov='UD';

update op_location set alternative_name='AQUILA DI ARROSCIA' where name like 'Aquila%' and prov='IM';

update op_location set alternative_name='SAN REMO' where name like 'Sanremo%' and prov='IM';

update op_location set alternative_name='RO FERRARESE' where name like 'Ro%' and prov='FE';

update op_location set alternative_name='MONTE GRIMANO' where name like 'Monte Grimano%' and prov='PU';

update op_location set alternative_name='MONTECOMPATRI' where name like 'Monte Compatri%' and prov='RM';

update op_location set alternative_name='SANNICANDRO GARGANICO' where name like 'San Nicand%' and prov='FG';

update op_location set alternative_name='IONADI' where name like 'Jonadi%' and prov='VV';

update op_location set alternative_name='CASTRONUOVO DI SICILIA' where name like 'Castronovo%' and prov='PA';

update op_location set alternative_name="NUGHEDU DI SAN NICOLO'" where name like 'Nughedu%' and prov='SS';
  
update op_location set alternative_name="LONATO" where name like 'Lonato%' and prov='BS';
  
update op_location set alternative_name="IESOLO" where name like 'Jesolo%' and prov='VE';
  
update op_location set alternative_name="COSIO DI ARROSCIA" where name like 'Cosio%' and prov='IM';
  
update op_location set alternative_name="POIANA MAGGIORE" where name like 'Pojana%' and prov='VI';
  
update op_location set alternative_name="BUIA" where name like 'Buja' and prov='UD';
  
update op_location set alternative_name="VO" where name like "Vo'" and prov='PD';
