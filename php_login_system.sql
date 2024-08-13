-- SQL: Database and table creation
CREATE DATABASE php_login_system; -- Creates a new database named "php_login_system".

USE php_login_system; -- Selects the "php_login_system" database to work with.

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT, -- An auto-incrementing primary key for each user.
    name VARCHAR(255) NOT NULL, -- The user's name, cannot be NULL.
    gender ENUM('Male', 'Female') NOT NULL, -- The user's gender, restricted to 'Male' or 'Female'.
    date_of_birth DATE NOT NULL, -- The user's date of birth, cannot be NULL.
    email VARCHAR(255) NOT NULL UNIQUE, -- The user's email, must be unique and cannot be NULL.
    phone_number VARCHAR(20) NOT NULL UNIQUE, -- The user's phone number, must be unique and cannot be NULL.
    password VARCHAR(255) NOT NULL, -- The user's password, stored as a hashed value, cannot be NULL.
    token VARCHAR(255) -- A token that might be used for password reset or other functionalities.
);
