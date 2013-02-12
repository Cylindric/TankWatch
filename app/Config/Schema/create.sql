DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `results`;
DROP TABLE IF EXISTS `tests`;
DROP TABLE IF EXISTS `units`;
DROP TABLE IF EXISTS `test_sets_tests`;
DROP TABLE IF EXISTS `test_sets`;

CREATE TABLE `users` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `username` VARCHAR(50),
    `password` VARCHAR(50),
    `role` VARCHAR(20),
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `users` (`username`, `password`, `role`) VALUES ('admin', 'admin', 'admin');
INSERT INTO `users` (`username`, `password`, `role`) VALUES ('user', 'user', 'user');


CREATE TABLE `units` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `abbreviation` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `units` (`name`, `abbreviation`) VALUES ('Unit', '');
INSERT INTO `units` (`name`, `abbreviation`) VALUES ('Degrees Celsius', '°C');
INSERT INTO `units` (`name`, `abbreviation`) VALUES ('Degrees Farenheit', '°F');
INSERT INTO `units` (`name`, `abbreviation`) VALUES ('Parts per million', 'ppm');
INSERT INTO `units` (`name`, `abbreviation`) VALUES ('pH', '');


CREATE TABLE `tests` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `code` VARCHAR(45) NOT NULL,
  `display_format` VARCHAR(45) NOT NULL DEFAULT '%f',
  PRIMARY KEY (`id`)
);
INSERT INTO `tests` (`name`, `code`, `display_format`) VALUES 
	('Temperature', 'temp', '%.1d'),
	('Acidity', 'pH', '%.1f'),
	('Nitrites', 'NO<sub>2</sub>', '%.1f'),
	('Nitrates', 'NO<sub>3</sub>', '%.1f'),
	('Ammonia', 'NH<sub>3</sub>', '%.1f'),
	('Ammonium', 'NH<sub>4</sub>', '%.1f')
;


CREATE TABLE `results` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `test_id` INT NOT NULL,
  `unit_id` INT NOT NULL,
  `test_set_id` INT NOT NULL,
  `time` DATETIME NOT NULL,
  `value` DOUBLE NOT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE `test_sets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE `test_sets_tests` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `test_id` INT NOT NULL,
  `test_set_id` INT NOT NULL,
  PRIMARY KEY (`id`)
);