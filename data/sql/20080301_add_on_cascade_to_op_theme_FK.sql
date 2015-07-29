alter table op_theme drop foreign key op_theme_FK;
alter table op_theme add foreign key op_theme_FK (content_id) references op_opinable_content (content_id) on delete cascade;
