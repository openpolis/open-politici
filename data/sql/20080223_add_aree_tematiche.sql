create unique index op_normalized_tag_idx on op_tag (normalized_tag);

insert ignore into op_tag values (null, "diritti civili", "diritticivili", now(), now());
insert ignore into op_tag values (null, "giustizia", 'giustizia', now(), now());
insert ignore into op_tag values (null, "economia", 'economia', now(), now());
insert ignore into op_tag values (null, "lavoro", 'lavoro', now(), now());
insert ignore into op_tag values (null, "infrastrutture", 'infrastrutture', now(), now());
insert ignore into op_tag values (null, "riforme istituzionali", 'riformeistituzionali', now(), now());
insert ignore into op_tag values (null, "istruzione e ricerca", 'istruzioneericerca', now(), now());
insert ignore into op_tag values (null, "ambiente", 'ambiente', now(), now());
insert ignore into op_tag values (null, "media e informazione", 'mediaeinformazione', now(), now());
insert ignore into op_tag values (null, "altro", 'altro', now(), now());
  