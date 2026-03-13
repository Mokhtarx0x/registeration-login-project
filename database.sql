-- Run this in phpMyAdmin > SQL tab

CREATE DATABASE IF NOT EXISTS webapp_db;

USE webapp_db;

CREATE TABLE IF NOT EXISTS users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50)  NOT NULL UNIQUE,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    first_name  VARCHAR(50)  NOT NULL,
    second_name VARCHAR(50)  NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
