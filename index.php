<?php
require_once('functions.php');
require_once('data.php'); 

$page_content = include_template('index.php', [
  'categories' => $categories,
  'lots' => $lots,
  'lotTime' => $lotTime
]);
$layout_content = include_template('layout.php', [ 
  'content' => $page_content,
  'categories' => $categories,
  'title' => 'YetiCave Главная страница',
  'is_auth' => rand(0, 1),
  'user_name' => 'Сергеев Игорь'
]);

print($layout_content);