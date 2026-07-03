CREATE DATABASE IF NOT EXISTS COMPUTING;
USE COMPUTING;

CREATE TABLE IF NOT EXISTS users (
    user_id     INT AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(100)        NOT NULL,
    username    VARCHAR(50)         NOT NULL UNIQUE,
    email       VARCHAR(100)        NOT NULL UNIQUE,
    password    VARCHAR(255)        NOT NULL,   -- stores a hashed password (never plain text)
    created_at  TIMESTAMP           DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;