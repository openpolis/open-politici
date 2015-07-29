create table if not exists op_theme (
  content_id int(10) unsigned NOT NULL,
  title varchar(255) not null,
  description text not null,
  relevancy_score int(10) default 0,
  PRIMARY KEY (content_id),
  UNIQUE KEY op_theme_idx (title),
  KEY op_theme_FKIndex1 (content_id),
	CONSTRAINT op_theme_FK FOREIGN KEY (content_id) REFERENCES op_opinable_content (content_id)
		ON UPDATE RESTRICT ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists op_theme_has_declaration (
  declaration_id int(10) unsigned NOT NULL,
  theme_id int(10) unsigned NOT NULL,
  position tinyint(1) NOT NULL,
  created_at datetime default NULL,
  PRIMARY KEY (declaration_id, theme_id),
  KEY op_theme_has_declaration_FKIndex1 (declaration_id),
  KEY op_theme_has_declaration_FKIndex2 (theme_id),
	CONSTRAINT op_theme_has_declaration_FK_1 FOREIGN KEY (declaration_id) REFERENCES op_declaration (content_id)
		ON UPDATE RESTRICT ON DELETE CASCADE,
	CONSTRAINT op_theme_has_declaration_FK_2 FOREIGN KEY (theme_id) REFERENCES op_theme (content_id)
		ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table if not exists op_theme_has_location (
  theme_id int(10) unsigned NOT NULL,
  location_id int(10) unsigned NOT NULL,
  PRIMARY KEY (theme_id, location_id),
  KEY op_theme_has_location_FKIndex1 (theme_id),
  KEY op_theme_has_location_FKIndex2 (location_id),
	CONSTRAINT op_theme_has_location_FK_1 FOREIGN KEY (theme_id) REFERENCES op_theme (content_id)
		ON UPDATE RESTRICT ON DELETE CASCADE,
	CONSTRAINT op_theme_has_location_FK_2 FOREIGN KEY (location_id) REFERENCES op_location (id)
		ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table if not exists op_holder_has_position_on_theme (
  id int(10) unsigned NOT NULL auto_increment,
  theme_id int(10) unsigned not null,
  party_id int(10) unsigned null,
  politician_id int(10) unsigned null,
  holder_type char(1) not null,
  PRIMARY KEY (id),
  KEY op_holder_has_position_on_theme_FKIndex1 (theme_id),
  KEY op_holder_has_position_on_theme_FKIndex2 (party_id),
  KEY op_holder_has_position_on_theme_FKIndex3 (politician_id),
	CONSTRAINT op_holder_has_position_on_theme_FK_1 FOREIGN KEY (theme_id) REFERENCES op_theme (content_id)
		ON UPDATE RESTRICT ON DELETE CASCADE,
	CONSTRAINT op_holder_has_position_on_theme_FK_2 FOREIGN KEY (party_id) REFERENCES op_party (id)
		ON UPDATE RESTRICT ON DELETE CASCADE,
	CONSTRAINT op_holder_has_position_on_theme_FK_3 FOREIGN KEY (politician_id) REFERENCES op_politician (content_id)
		ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

