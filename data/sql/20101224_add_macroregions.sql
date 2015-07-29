alter table op_location add macroregional_id int(10) unsigned after name;
insert into op_location_type values  (null, 'Macroregione');

set @loc_type_id := last_insert_id();

insert into op_location (location_type_id, name, macroregional_id) values (@loc_type_id, 'Nord Ovest', 1);
update op_location set macroregional_id=1 where regional_id in (1, 2, 3, 7);

insert into op_location (location_type_id, name, macroregional_id) values (@loc_type_id, 'Nord Est', 2);
update op_location set macroregional_id=2 where regional_id in (4, 5, 6, 8);

insert into op_location (location_type_id, name, macroregional_id) values (@loc_type_id, 'Centro', 3);
update op_location set macroregional_id=3 where regional_id in (9, 10, 11, 12);

insert into op_location (location_type_id, name, macroregional_id) values (@loc_type_id, 'Sud', 4);
update op_location set macroregional_id=4 where regional_id in (13, 14, 15, 16, 17, 18);

insert into op_location (location_type_id, name, macroregional_id) values (@loc_type_id, 'Isole', 5);  
update op_location set macroregional_id=5 where regional_id in (19, 20);