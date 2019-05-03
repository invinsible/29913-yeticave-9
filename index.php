<?php
require_once('functions.php');
$config = require_once('config/db.php');

$db = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);
mysqli_set_charset($db, "utf8");

$catSql = "SELECT * FROM categories";
$catResult = mysqli_query($db, $catSql);
if($catResult) {
  $categories = mysqli_fetch_all($catResult, MYSQLI_ASSOC);
} 

$lotSql = "SELECT lots.name AS lot_name, categories.name AS cat_name, lots.id AS lot_id, price, img, date_end FROM lots INNER JOIN categories ON lots.category_id = categories.id WHERE date_end >= NOW()";
$lotResult = mysqli_query($db, $lotSql);
if($catResult) {
  $lots = mysqli_fetch_all($lotResult, MYSQLI_ASSOC);
}


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



