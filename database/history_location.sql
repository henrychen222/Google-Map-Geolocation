

-- Table "history_location" DDL

CREATE TABLE `history_location` (
  `id` int(11) NOT NULL auto_increment,
  `other1` varchar(50) default NULL,
  `other2` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO history_location
   (`id`, `other1`, `other2`)
VALUES
   (1, '47.922604', '-97.071376');

INSERT INTO history_location
   (`id`, `other1`, `other2`)
VALUES
   (2, '47.921656', '-97.071781');

