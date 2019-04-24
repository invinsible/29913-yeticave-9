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
INSERT INTO lots (name, price, img, user_id, category_id, date_end, winner_id) 
VALUES
('2014 Rossignol District Snowboard', 10999, 'img/lot-1.jpg', 1, 1, '2019-04-24 17:10:50', 2),
('DC Ply Mens 2016/2017 Snowboard', 159999, 'img/lot-2.jpg', 2, 1, '2019-04-24 17:10:50', null),
('Крепления Union Contact Pro 2015 года размер L/X', 8000, 'img/lot-3.jpg', 2, 2, '2019-04-24 17:10:50', null),
('Ботинки для сноуборда DC Mutiny Charocal', 10999, 'img/lot-4.jpg', 1, 3, '2019-04-24 17:10:50', 3),
('Куртка для сноуборда DC Mutiny Charocal', 7500, 'img/lot-5.jpg', 2, 4, '2019-04-24 17:10:50', null),
('Маска Oakley Canopy', 5400, 'img/lot-6.jpg', 1, 4, '2019-04-24 17:10:50', 2);

/* Заполняем Ставки */
INSERT INTO costs (price, user_id, lot_id)
VALUES
(455, 2, 1),
(505, 3, 1);

/* Выводим все категории */
SELECT * FROM `categories`;

/* Выводим определенные поля открытых лотов */
SELECT name, price, img, category_id FROM lots WHERE winner_id != 0;

/* Отображение лота по id */
SELECT * FROM lots l JOIN categories c ON l.category_id = c.id WHERE l.id = 1;

/* Обновить имя лота по id */
UPDATE lots SET name = 'Test Udpate Lot' WHERE id = 1;