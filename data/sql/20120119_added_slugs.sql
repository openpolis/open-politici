ALTER TABLE op_constituency CHANGE slug slug VARCHAR(300) default '';

ALTER TABLE op_declaration ADD slug VARCHAR(300) default '';

ALTER TABLE op_institution ADD slug VARCHAR(300) default '';

ALTER TABLE op_location ADD slug VARCHAR(300) default '';

ALTER TABLE op_politician ADD slug VARCHAR(300) default '';
