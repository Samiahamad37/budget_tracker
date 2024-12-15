CREATE DATABASE budget_tracker;

USE budget_tracker;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
  

use budget_tracker;

CREATE TABLE transactions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    date date,
    category VARCHAR(50),
    amount DECIMAL(10,2)
    type 

)