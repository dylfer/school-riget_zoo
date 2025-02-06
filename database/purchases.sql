CREATE TABLE purchases (
    `purchase_id` INT(11) PRIMARY KEY,
    `payment_id` VARCHAR(36),-- stipe payment id
    `user_id` VARCHAR(36) NOT NULL,
    `type` ENUM('hotel', 'zoo') NOT NULL,
    `room_booking_id` INT(11),
    `ticket_booking_id` INT(11),
    `purchase_date` DATE default CURRENT_TIMESTAMP NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    `details` TEXT,
    PRIMARY KEY (`purchase_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`room_booking_id`) REFERENCES `hotel_bookings`(`id`),
    FOREIGN KEY (`ticket_booking_id`) REFERENCES `zoo_bookings`(`id`)
);