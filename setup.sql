CREATE DATABASE IF NOT EXISTS `myapp`;
USE `myapp`;
CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(35) NOT NULL,
  last_name VARCHAR(35) NOT NULL,
  email VARCHAR(45) NOT NULL,
  age INT(3) NULL,
  password VARCHAR(120) NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX email_UNIQUE (email ASC));