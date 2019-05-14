<?php
require_once(__DIR__ . '/inc/functions.php'); // Функции
require_once(__DIR__ . '/inc/queries.php'); // Вызовы и подключения
$configArr = require_once(__DIR__ . '/config/db.php'); // Конфигурация базы данных

$dbConnect = getConn($configArr);
$categories = getCategories($dbConnect); 


$lotSql = "SELECT lots.name AS lot_name, categories.name AS cat_name, lots.id AS lot_id, lots.description AS lot_descr, price, img, date_end FROM lots INNER JOIN categories ON lots.category_id = categories.id WHERE date_end >= NOW()";
$lotResult = mysqli_query($db, $lotSql);
if($catResult) {
  $lots = mysqli_fetch_all($lotResult, MYSQLI_ASSOC);
}


  $page_content = include_template('detail_page.php', [
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



