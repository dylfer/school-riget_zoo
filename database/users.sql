CREATE TABLE `users`(
    `id`         VARCHAR(36) NOT NULL,
    `username`   VARCHAR(50) NOT NULL,
    `email`      VARCHAR(100) NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `educational` BOOLEAN NOT NULL DEFAULT FALSE,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `token_secret`      VARCHAR(255) NOT NULL,
    `2fa_secret` VARCHAR(255) DEFAULT NULL,
    `mfa_enabled` BOOLEAN NOT NULL DEFAULT FALSE,
    `first_name` VARCHAR(30) NOT NULL,
    `last_name`  VARCHAR(30) NOT NULL,
    `phone`      VARCHAR(15),
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `email` (`email`)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;