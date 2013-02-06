INSERT INTO `tests` (`name`, `code`) VALUES ('Acidity', 'pH');
INSERT INTO `tests` (`name`, `code`) VALUES ('Nitrites', 'NO<sub>2</sub>');
INSERT INTO `tests` (`name`, `code`) VALUES ('Nitrates', 'NO<sub>3</sub>');
INSERT INTO `tests` (`name`, `code`) VALUES ('Ammonia', 'NH<sub>3</sub>');
INSERT INTO `tests` (`name`, `code`) VALUES ('Ammonium', 'NH<sub>4</sub>');

INSERT INTO `results` (`test_id`, `time`, `value`) SELECT `id`, NOW(), 6.5 FROM `tests` WHERE `name` = 'Acidity';