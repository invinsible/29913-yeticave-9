CREATE DATABASE yeticave_29913
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave_29913;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(68),
  code CHAR(68)  
);
CREATE UNIQUE INDEX catName ON categories(name);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create DATE,
  name CHAR(255),
  description TEXT,
  img CHAR(255),
  price INT,
  date_end DATE,
  cost INT,
  user INT,
  winner INT,
  category INT
);
CREATE INDEX lotName ON lots(name);
CREATE INDEX lotPrice ON lots(price);
CREATE INDEX lotCategory ON lots(category);

CREATE TABLE costs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create DATE,
  price INT,
  user INT,
  category INT  
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_register DATE,
  email CHAR(68),
  name CHAR(68),
  password CHAR(126),
  avatar CHAR(255),
  contacts TEXT,
  lot INT,
  cost INT  
);
CREATE UNIQUE INDEX email ON users(email);
CREATE INDEX userName ON users(name);

INSERT INTO categories
SET name = 'Доски и лыжи', code = 'boards';
INSERT INTO categories
SET name = 'Крепления', code = 'attachment';
INSERT INTO categories
SET name = 'Ботинки', code = 'boots';
INSERT INTO categories
SET name = 'Одежда', code = 'clothing';
INSERT INTO categories
SET name = 'Инструменты', code = 'tools';
INSERT INTO categories
SET name = 'Разное', code = 'other';