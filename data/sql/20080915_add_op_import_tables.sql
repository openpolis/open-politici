drop table if exists op_import_log;
drop table if exists op_import;
drop table if exists op_import_type;
drop table if exists op_import_minint;

CREATE TABLE if NOT EXISTS op_import_type (
  id int(10) unsigned NOT NULL auto_increment,
  name varchar(32) NOT NULL default '',
  PRIMARY KEY  (id),
  CONSTRAINT UNIQUE KEY op_import_type_name_idx (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into op_import_type (name) values ( 'parlamento' );
insert into op_import_type (name) values ( 'parlamento_eu' );
insert into op_import_type (name) values ( 'minint_regioni' );
insert into op_import_type (name) values ( 'minint_province' );
insert into op_import_type (name) values ( 'minint_comuni' );

CREATE TABLE if NOT EXISTS op_import_minint (
  id int(10) unsigned NOT NULL auto_increment,
  agg_date char(8) NOT NULL default '00000000',
  description varchar(255) default NULL,
  PRIMARY KEY  (id),
  CONSTRAINT UNIQUE KEY op_import_minint_date_idx (agg_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE if NOT EXISTS op_import (
  id int(10) unsigned NOT NULL auto_increment,
  import_type_id int(10) unsigned not null default 0,
  import_minint_id int(10) unsigned not null default 0,
  import_file varchar(255) default NULL,
  import_location varchar(255) default NULL,
  started_at datetime default NULL,
  finished_at datetime default NULL,
  run_type char(3) default NULL,
  total int(8) default NULL,
  errors int(8) default NULL,
  warnings int(8) default NULL,
  inserted integer(8) default NULL,
  PRIMARY KEY  (id),
  KEY op_import_minint_FKIndex1 (import_minint_id),
    CONSTRAINT op_import_minint_ibfk_2 FOREIGN KEY (import_minint_id) REFERENCES op_import_minint (id),
  KEY op_import_type_FKIndex2 (import_type_id),
    CONSTRAINT op_import_type_ibfk_1 FOREIGN KEY (import_type_id) REFERENCES op_import_type (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE if NOT EXISTS op_import_log (
  id int(10) unsigned NOT NULL auto_increment,
  import_id int(10) unsigned NOT NULL default 0,
  counter int(10) unsigned NOT NULL,
  type char(1) NOT NULL,
  created_at datetime default NULL,
  importing_data varchar(512),
  status varchar(5) NOT NULL,
  message varchar(512),
  PRIMARY KEY  (id),
  KEY op_import_log_status_idx (status),
  KEY op_import_log_type_idx (type),
  KEY op_import_log_counter_idx (counter),
  KEY op_import_FKIndex1 (import_id),
    CONSTRAINT op_import_ibfk_1 FOREIGN KEY (import_id) REFERENCES op_import (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;