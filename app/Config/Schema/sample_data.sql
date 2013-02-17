-- Reset data
DELETE FROM `results` WHERE `id` > 0;
DELETE FROM `species` WHERE `id` > 0;
DELETE FROM `species_transactions` WHERE `id` > 0;
DELETE FROM `tanks` WHERE `id` > 0;
DELETE FROM `test_sets_tests` WHERE `id` > 0;
DELETE FROM `test_sets` WHERE `id` > 0;
DELETE FROM `tests` WHERE `id` > 0;
DELETE FROM `users` WHERE `id` > 0;
DELETE FROM `units` WHERE `id` > 0;
