/* Clean installation to version 1 */;

DROP TABLE IF EXISTS `results`;
DROP TABLE IF EXISTS `species_tanks`;
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
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
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
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Species */;
CREATE TABLE `species` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`scientific_name` VARCHAR(255) NOT NULL DEFAULT '',
	`scientific_class` VARCHAR(255) NOT NULL DEFAULT '',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Species Tanks */;
CREATE TABLE `species_tanks` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`species_id` INT NOT NULL,
	`tank_id` INT NOT NULL,
	`quantity` INT NOT NULL,
	`note` VARCHAR(255) NOT NULL DEFAULT '',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX (`tank_id`, `species_id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Tanks */;
CREATE TABLE `tanks` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`width` FLOAT NOT NULL DEFAULT 0.0,
	`height` FLOAT NOT NULL DEFAULT 0.0,
	`depth` FLOAT NOT NULL DEFAULT 0.0,
	`volume` FLOAT NOT NULL DEFAULT 0.0,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX(`user_id`, `id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Test Set Tests */;
CREATE TABLE `test_sets_tests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`test_id` INT NOT NULL,
	`test_set_id` INT NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Test Sets */;
CREATE TABLE `test_sets` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX(`user_id`, `id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Tests */;
CREATE TABLE `tests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`code` VARCHAR(45) NOT NULL,
	`display_format` VARCHAR(45) NOT NULL DEFAULT '%f',
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Units */;
CREATE TABLE `units` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	`abbreviation` VARCHAR(45) NOT NULL,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Creating table Users */;
CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NOT NULL,
	`password` VARCHAR(50) NOT NULL,
	`role` VARCHAR(20) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
	`is_active` BIT NOT NULL DEFAULT 1,
	`created` DATETIME DEFAULT NULL,
	`modified` DATETIME DEFAULT NULL,
	PRIMARY KEY (`id`),
    UNIQUE KEY (`username`),
    UNIQUE KEY (`email`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;


/* Adding foreign key constraints to Results */;
ALTER TABLE `results`
	ADD CONSTRAINT `fk_results_users` FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
	ADD CONSTRAINT `fk_results_tests` FOREIGN KEY (test_id) REFERENCES tests(id) ON DELETE CASCADE,
	ADD CONSTRAINT `fk_results_units` FOREIGN KEY (unit_id) REFERENCES units(id) ON DELETE CASCADE,
	ADD CONSTRAINT `fk_results_test_sets` FOREIGN KEY (test_set_id) REFERENCES test_sets(id) ON DELETE CASCADE
;

/* Adding foreign key constraints to Species Tanks */;
ALTER TABLE `species_tanks`
	ADD CONSTRAINT `fk_species_tanks_species` FOREIGN KEY (species_id) REFERENCES species(id) ON DELETE CASCADE,
	ADD CONSTRAINT `fk_species_tanks_tanks` FOREIGN KEY (tank_id) REFERENCES tanks(id) ON DELETE CASCADE
;

/* Adding foreign key constraints to Tanks */;
ALTER TABLE `tanks`
	ADD CONSTRAINT `fk_tanks_users` FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
;

/* Adding foreign key constraints to Test Sets */;
ALTER TABLE `test_sets`
	ADD CONSTRAINT `fk_test_sets_users` FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
;
