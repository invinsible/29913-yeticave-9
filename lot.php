<?php
require_once(__DIR__ . '/inc/functions.php'); // Функции
require_once(__DIR__ . '/inc/queries.php'); // Вызовы и подключения
$configArr = require_once(__DIR__ . '/config/db.php'); // Конфигурация базы данных

$dbConnect = getConn($configArr);
$categories = getCategories($dbConnect);

if (isset($_GET['pageId']) && !empty($_GET['pageId']))  {   
  $pageId = mysqli_real_escape_string($dbConnect, $_GET['pageId']);
  $lot = getLot($dbConnect, $pageId);

} else {
  http_response_code(404);   
  $page_error = include_template('error.php', [
    'categories' => $categories,
    'title' => 'Страница не найдена',
    'is_auth' => rand(0, 1),
    'user_name' => 'Сергеев Игорь'  
  ]);  
  print($page_error);
  die();
}

$page_content = include_template('detail_page.php', [
    'categories' => $categories,
    'lot' => $lot
  ]);

  $layout_content = include_template('layout.php', [ 
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'YetiCave Главная страница',
    'is_auth' => rand(0, 1),
    'user_name' => 'Сергеев Игорь'
  ]);
  
  print($layout_content);



