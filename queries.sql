USE yeticave_29913;

/* Заполняем Категории */
INSERT INTO categories (name, code)
VALUES
('Доски и лыжи', 'boards'),
('Крепления', 'attachment'),
('Ботинки', 'boots'),
('Одежда', 'clothing'),
('Инструменты', 'tools'),
('Разное', 'other') ;

/* Заполняем Пользователей */
INSERT INTO users (name, email, password, avatar)
VALUES
('Иван Петров', 'ivan@mai.ru', 'qwerty', 'img/avatar.jpg'),
('Джон Сноу', 'jhon@mai.ru', 'qwerty', 'img/avatar.jpg'),
('Страшный Йети', 'noname@mail.ru', 'killall', 'img/avatar.jpg');

/* Заполняем Лоты */
INSERT INTO lots (name, price, img, user_id, category_id, date_end) 
VALUES
('2014 Rossignol District Snowboard', 10999, 'img/lot-1.jpg', 1, 1, '2019-04-24 17:10:50'),
('DC Ply Mens 2016/2017 Snowboard', 159999, 'img/lot-2.jpg', 2, 1, '2019-04-24 17:10:50'),
('Крепления Union Contact Pro 2015 года размер L/X', 8000, 'img/lot-3.jpg', 2, 2, '2019-04-24 17:10:50'),
('Ботинки для сноуборда DC Mutiny Charocal', 10999, 'img/lot-4.jpg', 1, 3, '2019-04-24 17:10:50'),
('Куртка для сноуборда DC Mutiny Charocal', 7500, 'img/lot-5.jpg', 2, 4, '2019-04-24 17:10:50'),
('Маска Oakley Canopy', 5400, 'img/lot-6.jpg', 1, 4, '2019-04-24 17:10:50');

/* Заполняем Ставки */
INSERT INTO costs (price, user_id, lot_id)
VALUES
(455, 2, 1),
(505, 3, 1);

SELECT * FROM `categories`;
