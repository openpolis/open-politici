drop table op_adoption;

create table op_pol_adoption (
  user_id int(10) unsigned NOT NULL default '0',
  politician_id int(10) unsigned NOT NULL default '0',
  requested_at datetime default NULL,
  granted_at datetime default NULL,
  revoked_at datetime default NULL,
  refused_at datetime default NULL,
  PRIMARY KEY (user_id, politician_id),
  KEY op_pol_adopt_FKIndex1 (user_id),
  KEY op_pol_adopt_FKIndex2 (politician_id),
  CONSTRAINT op_pol_adopt_ibfk_1 FOREIGN KEY (user_id) REFERENCES op_user (id) ON DELETE CASCADE,
  CONSTRAINT op_pol_adopt_ibfk_2 FOREIGN KEY (politician_id) REFERENCES op_politician (content_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table op_loc_adoption (
  user_id int(10) unsigned NOT NULL default '0',
  location_id int(10) unsigned NOT NULL default '0',
  requested_at datetime default NULL,
  granted_at datetime default NULL,
  revoked_at datetime default NULL,
  refused_at datetime default NULL,
  PRIMARY KEY (user_id, location_id),
  KEY op_loc_adopt_FKIndex1 (user_id),
  KEY op_loc_adopt_FKIndex2 (location_id),
  CONSTRAINT op_loc_adopt_ibfk_1 FOREIGN KEY (user_id) REFERENCES op_user (id) ON DELETE CASCADE,
  CONSTRAINT op_loc_adopt_ibfk_2 FOREIGN KEY (location_id) REFERENCES op_location (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

alter table op_profession add column oid int(10) unsigned default NULL;
alter table op_profession add column odescription varchar(255) default NULL;