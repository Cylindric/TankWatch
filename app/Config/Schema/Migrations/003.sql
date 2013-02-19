/* Updating to 3 */;

/* Adding extra User fields */;
ALTER TABLE `users`
ALTER COLUMN `username` VARCHAR(50) NOT NULL,
ALTER COLUMN `password` VARCHAR(50) NOT NULL,
ALTER COLUMN `role` VARCHAR(20) NOT NULL,
ADD COLUMN `email` VARCHAR(50) NOT NULL AFTER `role`
ADD UNIQUE KEY (`username`),
ADD UNIQUE KEY (`email`)
;


/* Setting version to 3 */;
INSERT INTO `versions` (`version`, `description`, `created`, `modified`) VALUES (3, 'Upgrade to v3', NOW(), NOW());
