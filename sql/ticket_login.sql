USE c12st10;
DROP TABLE IF EXISTS `ticket_login`;
CREATE TABLE `ticket_login`(
	`fly_date` date NOT NULL,
	`fly_start_time` time NOT NULL,
	`fly_finish_time` time NOT NULL,
	`fly_name` varchar(20) NOT NULL,
	`fly_all_sit` int(10) NOT NULL,
	`fly_nam_sit` int(10) NOT NULL,
	`fly_charge` int(15) NOT NULL
);
INSERT INTO `ticket_login` VALUES('2021-06-17','13:00:00','15:30:00','cdr-c1210','250','120','120000');
 INSERT INTO `ticket_login` VALUES('2021-06-19','15:00:00','17:30:00','cdr-c1203','210','180','250000');
