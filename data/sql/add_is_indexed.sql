alter table op_politician add column is_indexed tinyint(4) not null default 0;
create index op_politician_indexed_idx on op_politician (is_indexed);
#alter table op_opinable_content add column is_indexed tinyint(4) not null default 0;
#create index op_opinable_content_indexed_idx on op_opinable_content (is_indexed);
  