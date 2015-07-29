alter table op_user change column want_newsletter wants_newsletter tinyint not null default 0 after remember_key;
