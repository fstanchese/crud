CREATE TABLE `categoria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ;
 
 CREATE TABLE `filme` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `categoria_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `filme_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8
 


