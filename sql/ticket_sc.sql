USE c12st10;
DROP TABLE IF EXISTS `ticket_sc`;
CREATE TABLE `ticket_sc`(
	`st_adr` varchar(100) NOT NULL,
	`lt_adr` varchar(100) NOT NULL,
	`stay_name` char(70) NOT NULL,
	`stay_birth` date NOT NULL,
	`stay_name_en` varchar(100) NOT NULL,
	`stay_sex` enum('남자','여자') NOT NULL,
	`stay_lange` enum('성인','유아') NOT NULL,
	`booking_num` int(100) NOT NULL,
	`booking_num_num` int(100) NOT NULL,
	`flying_length` char(10) NOT NULL,
	`booking_id` varchar(15) NOT NULL,
	`id_number` int(100) NOT NULL,
	`fly_start` date NOT NULL,
	`fly_chage` int(100) NOT NULL,
	`fly_name` varchar(30) NOT NULL,
	PRIMARY KEY(`id_number`)
)AUTO_INCREMENT = 10000;
INSERT INTO `ticket_sc` VALUES('inchoen','tokyo','김장연','1990-11-26','KIM JANGYEON','남자','성인','110110111','1','2.5','jkjkql00','2021-6-16','120000','cdr-c1210');
