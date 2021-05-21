CREATE TABLE `developers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `sexo` char(1) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `hobby` varchar(50) DEFAULT NULL,
  `dnascto` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
