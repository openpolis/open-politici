ALTER TABLE `op_location` ADD `date_start` DATE;
ALTER TABLE `op_location` ADD `date_end` DATE;
ALTER TABLE `op_location` ADD `new_location_id` INT(10);

-- il comune di Ledro è fusione dei comuni di 
-- Pieve di Ledro, Bezzecca, Concei, Molina di Ledro, Tiarno di sopra e Tiarno di Sotto
-- a partire dal 1. gennaio 2010
insert into op_location 
  (id, location_type_id, name, regional_id, provincial_id, city_id, prov, inhabitants, 
       date_start) 
  values
  (null, 6, 'Ledro', 4, 22, 22229, 'TN', 5300, '2010-01-01');
  
update op_location set date_end='2010-01-01', new_location_id=LAST_INSERT_ID() where id in (3130, 3008, 3056, 3109, 3186, 3187);
  
  
-- il comune di Comano terme è fusione dei comuni di 
-- Bleggio inferiore e Lomaso
-- a partire dal 1. gennaio 2010
insert into op_location 
  (id, location_type_id, name, regional_id, provincial_id, city_id, prov, inhabitants, 
       date_start) 
  values
  (null, 6, 'Comano Terme', 4, 22, 22228, 'TN', 2673, '2010-01-01');

update op_location set date_end='2010-01-01', new_location_id=LAST_INSERT_ID() where id in (3010, 3097);


-- il comune di Campolongo Tapogliano è fusione dei comuni di 
-- Campolongo al Torre e Tapogliano
-- a partire dal 1. gennaio 2009
-- qui i codici minint sono già noti
insert into op_location 
  (id, location_type_id, name, regional_id, provincial_id, city_id, prov, inhabitants,
       minint_regional_code, minint_provincial_code, minint_city_code,
       date_start) 
  values
  (null, 6, 'Campolongo Tapogliano', 6, 30, 30138, 'UD', 1213, 6, 85, 175, '2009-01-01');

update op_location set date_end='2009-01-01', new_location_id=LAST_INSERT_ID() where id in (3813, 3912);
