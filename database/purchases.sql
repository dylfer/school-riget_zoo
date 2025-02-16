CREATE TABLE purchases (
    `purchase_id` INT(11),
    `user_id` VARCHAR(36) NOT NULL,
    `type` ENUM('hotel', 'zoo') NOT NULL,
    `room_booking_id` INT(11),
    `ticket_booking_id` INT(11),
    `purchase_date` TIMESTAMP default CURRENT_TIMESTAMP NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    `details` TEXT,
    PRIMARY KEY (`purchase_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`room_booking_id`) REFERENCES `hotel_bookings`(`room_no`),
    FOREIGN KEY (`ticket_booking_id`) REFERENCES `zoo_bookings`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;