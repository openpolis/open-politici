alter table op_party add electoral tinyint(1) unsigned not null default 0 after main;
alter table op_party add logo mediumblob;

ALTER TABLE op_theme_has_declaration 
 ADD COLUMN party_id INTEGER UNSIGNED AFTER theme_id,
 ADD INDEX op_theme_has_declaration_FKIndex3 (party_id),
 ADD CONSTRAINT op_theme_has_declaration_FK_3 FOREIGN KEY (party_id) REFERENCES op_party (id) ON DELETE SET NULL;
