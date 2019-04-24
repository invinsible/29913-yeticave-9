CREATE DATABASE yeticave_29913
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave_29913;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(68),
  code CHAR(68)  
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create DATE,
  name CHAR(255),
  description TEXT,
  img CHAR(255),
  price INT,
  date_end DATE,
  cost INT,
  user_id INT,
  winner_id INT,
  category_id INT
);

CREATE TABLE costs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create DATE,
  price INT,
  user_id INT,
  lot_id INT  
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_register DATE,
  email CHAR(68),
  name CHAR(68),
  password CHAR(126),
  avatar CHAR(255),
  contacts TEXT,
  lot_id INT,
  cost_id INT  
);

CREATE UNIQUE INDEX email ON users(email);
CREATE INDEX userName ON users(name);
CREATE UNIQUE INDEX catName ON categories(name);
CREATE INDEX lotName ON lots(name);
CREATE INDEX lotPrice ON lots(price);
CREATE INDEX lotCategory ON lots(category_id);
ALTER TABLE lots ADD FOREIGN KEY (category_id) REFERENCES categories (id);
ALTER TABLE lots ADD FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE lots ADD FOREIGN KEY (winner_id) REFERENCES users (id);
ALTER TABLE costs ADD FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE costs ADD FOREIGN KEY (lot_id) REFERENCES lots (id);
ALTER TABLE users ADD FOREIGN KEY (lot_id) REFERENCES lots (id);
ALTER TABLE users ADD FOREIGN KEY (cost_id) REFERENCES costs (id);


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