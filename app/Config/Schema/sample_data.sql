-- Reset data
TRUNCATE TABLE `results`;
TRUNCATE TABLE `species`;
TRUNCATE TABLE `species_transactions`;
TRUNCATE TABLE `tanks`;
TRUNCATE TABLE `test_sets_tests`;
TRUNCATE TABLE `test_sets`;
TRUNCATE TABLE `tests`;
DELETE FROM `users` WHERE `username` <> 'admin' AND `id` > 0;
TRUNCATE TABLE`units`;
