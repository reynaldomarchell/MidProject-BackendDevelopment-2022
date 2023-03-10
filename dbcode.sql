CREATE DATABASE todo_list;

USE todo_list;

CREATE TABLE users (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(20) NOT NULL,
  user_name VARCHAR(15) NOT NULL,
  password VARCHAR(20) NOT NULL,
  date TIMESTAMP
);

CREATE TABLE completed (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(15) NOT NULL,
  task VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(15) NOT NULL,
  task VARCHAR(255) NOT NULL
);