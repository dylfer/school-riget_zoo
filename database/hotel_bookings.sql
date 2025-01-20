CREATE TABLE `rooms` (
  `room_no` INT(11) NOT NULL,
  `type` ENUM('Standard','Dobble','Triple','Suite','Dulux','Connecting') NOT NULL,
  `Beds` VARCHAR(36) NOT NULL,
  `cleaned` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`room_no`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;