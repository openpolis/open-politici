alter table op_user add column public_name tinyint(1) not null default 1;
alter table op_user change column nickname nickname varchar(16) default null;
alter table op_user change column want_newsletter want_newsletter tinyint(1) not null default 0;
alter table op_user add unique op_user_email_idx (email);
alter table op_user add unique op_user_sha1_idx (sha1_password);
