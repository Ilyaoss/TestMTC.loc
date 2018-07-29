create database testdb;
use testdb;
CREATE TABLE users(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
login VARCHAR(20) NOT NULL,
password VARCHAR(225) NOT NULL,
HASH VARCHAR(225) ,
image VARCHAR(225),
bdate date
);
CREATE TABLE pet(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(20) NOT NULL,
age INT NOT NULL,
description VARCHAR(225),
owner_id int NOT NULL,
image VARCHAR(225),
FOREIGN KEY (owner_id) REFERENCES users(id)
);