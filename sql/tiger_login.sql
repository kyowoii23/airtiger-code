USE c12st10;
DROP TABLE IF EXISTS `tiger_login`;
CREATE TABLE `tiger_login`(
	`id_num` int(100) NOT NULL AUTO_INCREMENT,
	`id` varchar(20) NOT NULL UNIQUE,
	`pwd` char(50) NOT NULL,
	`name` char(50) NOT NULL,
	`birth` date NOT NULL,
	`tel` varchar(30) NOT NULL,
	`name_en` varchar(50),
	`sex` enum('남자','여자') NOT NULL,
	`country` char(30) NOT NULL,
	`address` varchar(100) NOT NULL,
	`mail` char(70),
	PRIMARY KEY(`id_num`)
)AUTO_INCREMENT = 10000;
INSERT INTO `tiger_login` VALUES("1","admin","81dc9bdb52d04dc20036dbd8313ed055","마스터","2021-05-06","010-2222-2222","master","남자","korea","경기도 안산시","air-tiger@google.com");
