INSERT INTO `species` (`name`, `scientific_name`, `scientific_class`, `created`, `modified`)
VALUES 
	('Gold Cobra Guppy', 'Actinopterygii', 'Poecilia reticulata', NOW(), NOW()),
	('Purple Harlequin Rasbora', 'Actinopterygii', 'Trigonostigma heteromorpha', NOW(), NOW()),
	('Red Cherry Shrimp', 'Malacostraca', 'Neocaridina heteropoda', NOW(), NOW()),
	('Gold Ring Butterfly Sucker', 'Actinopterygii', 'Balitora lineolata', NOW(), NOW()),
	('Rosy Barb', 'Actinopterygii', 'Pethia conchonius', NOW(), NOW()),
	('Snakeskin Guppy', 'Actinopterygii', 'Poecilia reticulata', NOW(), NOW()),
	('Bamboo Shrimp', 'Malacostraca', 'Atyopsis', NOW(), NOW()),
	('Red Tailed Shark', 'Actinopterygii', 'Epalzeorhynchos bicolor', NOW(), NOW())
;


SELECT * FROM `units`;
SELECT * FROM `users`;
SELECT * FROM `species`;

DELETE FROM users;
DELETE FROM units;