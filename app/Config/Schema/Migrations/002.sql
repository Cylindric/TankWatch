/* Updating to 2 */;

/* Adding Scientific Name to Species */;
ALTER TABLE `species` 
ADD COLUMN `scientific_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'The full scientific name' AFTER `name`,
ADD COLUMN `scientific_class` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'The full scientific class' AFTER `scientific_name`
;


/* Setting version to 2 */;
INSERT INTO `versions` (`version`, `description`, `created`, `modified`) VALUES (2, 'Upgrade to v2', NOW(), NOW());
