CREATE TABLE op_api_keys (
  id int(10) unsigned not null auto_increment,
  req_name varchar(128) not null,
  req_contact varchar(255) not null default '',
  req_description text,
  value varchar(64),
  requested_at datetime default NULL,
  granted_at datetime default NULL,
  revoked_at datetime default NULL,
  refused_at datetime default NULL,
  PRIMARY KEY  (id),
  constraint unique index api_keys_value_idx (value)
) ENGINE=InnoDB DEFAULT CHARSET=utf8