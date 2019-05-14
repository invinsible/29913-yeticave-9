<?php
require_once(__DIR__ . '/inc/functions.php'); // Функции
require_once(__DIR__ . '/inc/queries.php'); // Вызовы и подключения
$configArr = require_once(__DIR__ . '/config/db.php'); // Конфигурация базы данных

if (isset($_GET['pageId']) && !empty($_GET['pageId']))  {    
  $dbConnect = getConn($configArr);
  $pageId = mysqli_real_escape_string($dbConnect, $_GET['pageId']);
  $categories = getCategories($dbConnect); 
  $lot = getLot($dbConnect, $pageId);

} else {
  http_response_code(404);
  include_template('error.php', [
    'categories' => $categories    
  ]);
  header("location: /pages/404.html");
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



