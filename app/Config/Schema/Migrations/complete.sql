/* Clean installation to version 1 */;

DROP TABLE IF EXISTS `results`;
DROP TABLE IF EXISTS `species_transactions`;
DROP TABLE IF EXISTS `species`;
DROP TABLE IF EXISTS `tanks`;
DROP TABLE IF EXISTS `test_sets_tests`;
DROP TABLE IF EXISTS `test_sets`;
DROP TABLE IF EXISTS `tests`;
DROP TABLE IF EXISTS `units`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `versions`;


/* Creating table Versions and setting version to 1 */;
CREATE TABLE `versions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`version` INT NOT NULL DEFAULT 0,
	`description` VARCHAR(255) NULL DEFAULT '',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);
INSERT INTO `versions` (`version`, `description`, `created`, `modified`) VALUES (1, 'Initial installation', NOW(), NOW());


/* Creating table Results */;
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


/* Creating table Species */;
CREATE TABLE `species` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

/* Creating table Species Transactions */;
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

/* Creating table Tanks */;
CREATE TABLE `tanks` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`width` FLOAT NOT NULL DEFAULT 0.0 COMMENT 'The width across the front of the tank, in cm.',
	`height` FLOAT NOT NULL DEFAULT 0.0 COMMENT 'The height of the the tank, in cm.',
	`depth` FLOAT NOT NULL DEFAULT 0.0 COMMENT 'The front-to-back depth of the tank, in cm.',
	`volume` FLOAT NOT NULL DEFAULT 0.0 COMMENT 'The water volume in the tank, in litres.',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX(`user_id`, `id`)
);

/* Creating table Test Set Tests */;
CREATE TABLE `test_sets_tests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`test_id` INT NOT NULL,
	`test_set_id` INT NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

/* Creating table Test Sets */;
CREATE TABLE `test_sets` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX(`user_id`, `id`)
);

/* Creating table Tests */;
CREATE TABLE `tests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`code` VARCHAR(45) NOT NULL,
	`display_format` VARCHAR(45) NOT NULL DEFAULT '%f',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

/* Creating table Units */;
CREATE TABLE `units` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`abbreviation` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);

/* Creating table Users */;
CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50),
	`password` VARCHAR(50),
	`role` VARCHAR(20),
	`is_active` BIT NOT NULL DEFAULT 1,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
);


/* Adding foreign key constraints to Results */;
ALTER TABLE `results`
	ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (test_id) REFERENCES tests(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (unit_id) REFERENCES units(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (test_set_id) REFERENCES test_sets(id) ON DELETE CASCADE
;

/* Adding foreign key constraints to Species Transactions */;
ALTER TABLE `species_transactions`
	ADD FOREIGN KEY (species_id) REFERENCES species(id) ON DELETE CASCADE,
	ADD FOREIGN KEY (tank_id) REFERENCES tanks(id) ON DELETE CASCADE
;

/* Adding foreign key constraints to Tanks */;
ALTER TABLE `tanks`
	ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
;

/* Adding foreign key constraints to Test Sets */;
ALTER TABLE `test_sets`
	ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
;