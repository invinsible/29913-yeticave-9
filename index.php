<?php
require_once(__DIR__ . '/inc/functions.php'); // Функции
require_once(__DIR__ . '/inc/queries.php'); // Вызовы и подключения
$configArr = require_once(__DIR__ . '/config/db.php'); // Конфигурация базы данных

$dbConnect = getConn($configArr);
$categories = getCategories($dbConnect);  
$lots = getLots($dbConnect);


$page_content = include_template('index.php', [
  'categories' => $categories,
  'lots' => $lots
]);

$layout_content = include_template('layout.php', [ 
  'content' => $page_content,
  'categories' => $categories,
  'title' => 'YetiCave Главная страница',
  'is_auth' => rand(0, 1),
  'user_name' => 'Сергеев Игорь'
]);

print($layout_content);



