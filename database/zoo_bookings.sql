CREATE TABLE `zoo_bookings` (
  `id` INT(11) NOT NULL,
    `user_id` VARCHAR(36) NOT NULL,
    `booking_code` VARCHAR(36) NOT NULL,
    `status` ENUM('pending', 'confirmed', 'completed', 'cancelled','refunded') NOT NULL DEFAULT 'pending',
    `adult_tickets` INT(11) NOT NULL,
    `child_tickets` INT(11) NOT NULL,
    `date` DATETIME NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;