CREATE TABLE `op_session` (
  `sess_id` varchar(32) NOT NULL,
  `sess_data` text NOT NULL,
  `sess_time` int(11) NOT NULL,
  PRIMARY KEY  (`sess_id`),
  KEY `sess_time_idx` (`sess_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8