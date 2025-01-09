CREATE TABLE `hotel_bookings` (
  `id` INT(11) NOT NULL,
    `user_id` VARCHAR(36) NOT NULL,
    `booking_code` VARCHAR(36) NOT NULL,
    `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    `check_in` DATETIME NOT NULL,
    `check_out` DATETIME NOT NULL,
    `people` INT(11) NOT NULL,
    `room_no` INT(11) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
  FOREIGN KEY (`room_no`) REFERENCES `rooms`(`room_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;