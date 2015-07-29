# la chiave primaria è composta da tre campi: import_file, import_log_counter e user_id
# quando un record esiste, significa che l'utente user_id vuole indicare come CHECKED 
# il record import_counter del file import_file
#
# import_counter e import_file non possono essere chiavi esterne, perché deve
# essere possibile rimuovere i record delle tabelle cui appartengono senza
# alcun tipo di constraint

drop table if exists op_import_user_check;
CREATE TABLE if NOT EXISTS op_import_user_check (
  import_file        varchar(255) not null,
  import_log_counter integer(10) not null,
  user_id            integer(10) unsigned default null,
  created_at         datetime default null,
  PRIMARY KEY (import_file, import_log_counter),
  INDEX op_import_user_check_FK1 (import_file),
  INDEX op_import_user_check_FK2 (import_log_counter),
  INDEX op_import_user_check_FK3 (user_id),
  CONSTRAINT op_import_user_check_FK_3 FOREIGN KEY (user_id) REFERENCES op_user (id)
	  ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
