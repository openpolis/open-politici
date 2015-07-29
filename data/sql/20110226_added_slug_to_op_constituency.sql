alter table op_constituency add column slug varchar(128) after name;
-- table must be re-imported, or values must be filled