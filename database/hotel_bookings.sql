CREATE TABLE `hotel_bookings` (
  `room_no` INT(11) NOT NULL,
  `booking_code` VARCHAR(36) NOT NULL,
  `status` ENUM('pending', 'confirmed', 'completed', 'cancelled','refunded') NOT NULL DEFAULT 'pending',
  `user_id` VARCHAR(36) NOT NULL,
  `type` ENUM('Standard','Dobble','Triple','Suite','Dulux','Connecting') NOT NULL,
  `Beds` VARCHAR(36) NOT NULL,
  `adults` INT(11) NOT NULL,
  `children` INT(11) NOT NULL,
  `check_in` DATE NOT NULL,
  `check_out` DATE NOT NULL,
  PRIMARY KEY (`room_no`)
  FOREIGN KEY (`room_no`) REFERENCES `rooms`(`room_no`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;