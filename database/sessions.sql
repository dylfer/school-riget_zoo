CREATE TABLE `sessions` (
  `session_id` VARCHAR(36) NOT NULL,
  `previous_session_id` VARCHAR(36) DEFAULT NULL,
  `user_id` VARCHAR(36),
  `login_status` BOOLEAN DEFAULT FALSE,
  `token` VARCHAR(255) DEFAULT NULL,
  `last_updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `save_data` TEXT,
  `ip_address` VARCHAR(45) NOT NULL,
  `user_agent` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`session_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;