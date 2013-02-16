DROP TABLE IF EXISTS `results`;
DROP TABLE IF EXISTS `species`;

DROP TABLE IF EXISTS `species_transactions`;
DROP TABLE IF EXISTS `tanks`;

DROP TABLE IF EXISTS `test_sets_tests`;
DROP TABLE IF EXISTS `test_sets`;
DROP TABLE IF EXISTS `tests`;
DROP TABLE IF EXISTS `units`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `results` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`test_id` INT NOT NULL,
	`unit_id` INT NOT NULL,
	`test_set_id` INT NOT NULL,
	`time` DATETIME NOT NULL,
	`value` DOUBLE NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX(`test_id`),
	INDEX(`user_id`),
	INDEX(`unit_id`),
	INDEX(`test_set_id`)
);


CREATE TABLE `species` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `species_transactions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`species_id` INT NOT NULL,
	`tank_id` INT NOT NULL,
	`quantity` INT NOT NULL,
	`note` VARCHAR(255) NOT NULL DEFAULT '',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX (`tank_id`, `species_id`)
);

CREATE TABLE `tanks` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX(`user_id`, `id`)
);

CREATE TABLE `test_sets_tests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`test_id` INT NOT NULL,
	`test_set_id` INT NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `test_sets` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX(`user_id`, `id`)
);

CREATE TABLE `tests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`code` VARCHAR(45) NOT NULL,
	`display_format` VARCHAR(45) NOT NULL DEFAULT '%f',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `units` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`abbreviation` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50),
    `password` VARCHAR(50),
    `role` VARCHAR(20),
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
);


ALTER TABLE `results`
	ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (test_id) REFERENCES tests(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (unit_id) REFERENCES units(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (test_set_id) REFERENCES test_sets(id) ON DELETE CASCADE
;

ALTER TABLE `species_transactions`
	ADD FOREIGN KEY (species_id) REFERENCES species(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (tank_id) REFERENCES tanks(id) ON DELETE CASCADE
;

ALTER TABLE `tanks`
	ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
;

ALTER TABLE `test_sets`
	ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
;


INSERT INTO `species` (`name`) VALUES
	('Gold Cobra Guppy'),
	('Purple Harlequin Rasbora'),
	('Red Cherry Shrimp'),
	('Gold Ring Butterfly Sucker'),
	('Rosy Barb'),
	('Snakeskin Guppy'),
	('Bamboo Shrimp')
;

INSERT INTO `tests` (`name`, `code`, `display_format`) VALUES 
	('Temperature', 'temp', '%.1d'),
	('Acidity', 'pH', '%.1f'),
	('Nitrites', 'NO<sub>2</sub>', '%.1f'),
	('Nitrates', 'NO<sub>3</sub>', '%.1f'),
	('Ammonia', 'NH<sub>3</sub>', '%.1f'),
	('Ammonium', 'NH<sub>4</sub>', '%.1f')
;

INSERT INTO `units` (`name`, `abbreviation`) VALUES 
	('Unit', ''),
	('Degrees Celsius', '°C'),
	('Degrees Farenheit', '°F'),
	('Parts per million', 'ppm'),
	('pH', '')
;

INSERT INTO `users` (`username`, `password`, `role`) VALUES 
	('admin', 'admin', 'admin')
;
