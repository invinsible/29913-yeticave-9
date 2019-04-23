CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(68),
  code CHAR(68)  
);

INSERT INTO category
SET name = 'Доски и лыжи', code = 'boards';
INSERT INTO category
SET name = 'Крепления', code = 'attachment';
INSERT INTO category
SET name = 'Ботинки', code = 'boots';
INSERT INTO category
SET name = 'Одежда', code = 'clothing';
INSERT INTO category
SET name = 'Инструменты', code = 'tools';
INSERT INTO category
SET name = 'Разное', code = 'other';