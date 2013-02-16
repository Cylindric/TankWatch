select * from results;
select * from tests;
select * from tanks;
select * from users;
select * from units;
select * from species_transactions;
select * from test_sets;
select * from test_sets_tests;

update tests set display_format='%0.1f' where id =1;

update results set unit_id=2 where id>0;

SELECT `Result`.`id`, `Result`.`user_id`, `Result`.`test_id`, `Result`.`unit_id`, `Result`.`test_set_id`, DATE(`Result`.`time`) AS `date`, `Result`.`value`, `Test`.`id`, `Test`.`name`, `Test`.`code`, `Test`.`display_format`, (CONCAT(`Test`.`name`, " (", `Test`.`code`, ")")) AS `Test__display_name`, `TestSet`.`id`, `TestSet`.`user_id`, `TestSet`.`name` 
FROM `tankwatch`.`results` AS `Result` 
LEFT JOIN `tankwatch`.`tests` AS `Test` ON (`Result`.`test_id` = `Test`.`id`) 
LEFT JOIN `tankwatch`.`test_sets` AS `TestSet` ON (`Result`.`test_set_id` = `TestSet`.`id` AND `TestSet`.`id` = 1) 
WHERE `Result`.`user_id` = 2
ORDER BY `Result`.`time`;


-- current "live" species list
SELECT tank.id tank_id, tank.name, species.id species_id, species.name, SUM(tx.quantity) qty
FROM `species_transactions` tx
LEFT JOIN `species` species ON (tx.species_id = species.id)
LEFT JOIN `tanks` tank ON (tx.tank_id = tank.id)
WHERE tank.user_id = 2
GROUP BY tank.id, tank.name, species.id, species.name
HAVING SUM(tx.quantity) > 0;