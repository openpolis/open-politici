update op_location set minint_regional_code = 4, minint_provincial_code = 83, minint_city_code = 0965 where id=8234;
update op_location set minint_regional_code = 4, minint_provincial_code = 83, minint_city_code = 0595 where id=8235;
  
update op_location set alternative_name = 'Trentino-Alto Adige' where id=6;
update op_location set alternative_name = 'Friuli-Venezia Giulia' where id=8;
update op_location set alternative_name = null where alternative_name = 'abruzzi';  

update op_location set city_id=99022, minint_city_code=45, provincial_id=99, regional_id=8, macroregional_id=2, minint_provincial_code=101, minint_regional_code=8, prov='RN' where id=4309;
update op_location set city_id=99021, minint_city_code=15, provincial_id=99, regional_id=8, macroregional_id=2, minint_provincial_code=101, minint_regional_code=8, prov='RN' where id=4296;
update op_location set city_id=99023, minint_city_code=115, provincial_id=99, regional_id=8, macroregional_id=2, minint_provincial_code=101, minint_regional_code=8, prov='RN' where id=4324;
update op_location set city_id=99024, minint_city_code=116, provincial_id=99, regional_id=8, macroregional_id=2, minint_provincial_code=101, minint_regional_code=8, prov='RN' where id=4326;
update op_location set city_id=99025, minint_city_code=175, provincial_id=99, regional_id=8, macroregional_id=2, minint_provincial_code=101, minint_regional_code=8, prov='RN' where id=4337;
update op_location set city_id=99026, minint_city_code=176, provincial_id=99, regional_id=8, macroregional_id=2, minint_provincial_code=101, minint_regional_code=8, prov='RN' where id=4339;
update op_location set city_id=99027, minint_city_code=185, provincial_id=99, regional_id=8, macroregional_id=2, minint_provincial_code=101, minint_regional_code=8, prov='RN' where id=4347;
  