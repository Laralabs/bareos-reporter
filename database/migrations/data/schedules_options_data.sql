INSERT INTO `schedules_options` (`id`, `type`, `name`, `display_name`, `enabled`, `created_at`, `updated_at`)
VALUES
	(1, 'freq', 'hourly', 'Hourly', 0, NULL, NULL),
	(2, 'freq', 'daily', 'Daily (Runs at Midnight)', 1, NULL, NULL),
	(3, 'freq', 'dailyat', 'Daily At', 1, NULL, NULL),
	(4, 'freq', 'weekly', 'Weekly', 0, NULL, NULL),
	(5, 'freq', 'monthly', 'Monthly', 0, NULL, NULL),
	(6, 'freq', 'quarterly', 'Quarterly', 0, NULL, NULL),
	(7, 'freq', 'yearly', 'Yearly', 0, NULL, NULL),
	(8, 'add_freq', 'weekdays', 'Weekdays', 1, NULL, NULL),
	(9, 'add_freq', 'sundays', 'Sunday', 1, NULL, NULL),
	(10, 'add_freq', 'mondays', 'Monday', 1, NULL, NULL),
	(11, 'add_freq', 'tuesdays', 'Tuesday', 1, NULL, NULL),
	(12, 'add_freq', 'wednesdays', 'Wednesday', 1, NULL, NULL),
	(13, 'add_freq', 'thursdays', 'Thursday', 1, NULL, NULL),
	(14, 'add_freq', 'fridays', 'Friday', 1, NULL, NULL),
	(15, 'add_freq', 'saturdays', 'Saturday', 1, NULL, NULL);
