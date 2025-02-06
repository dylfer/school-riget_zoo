CREATE TABLE `rooms` (
  `room_no` INT(11) NOT NULL,
  `type` ENUM('Standard','Double','Triple','Suite','Deluxe','Connecting') NOT NULL,
  `Beds` VARCHAR(36) NOT NULL,
  `people` VARCHAR(10) NOT NULL,-- low max - high max
  `cleaned` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`room_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;