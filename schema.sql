CREATE DATABASE yeticave_29913
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave_29913;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(68) NOT NULL,
  code CHAR(68) NOT NULL  
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  name CHAR(255) NOT NULL,
  description TEXT,
  img CHAR(255),
  price INT NOT NULL,
  date_end TIMESTAMP NOT NULL,
  cost INT,
  user_id INT NOT NULL,
  winner_id INT,
  category_id INT NOT NULL
);

CREATE TABLE costs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  price INT NOT NULL,
  user_id INT NOT NULL,
  lot_id INT NOT NULL 
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_register TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  email CHAR(128) NOT NULL,
  name CHAR(68) NOT NULL,
  password CHAR(126) NOT NULL,
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