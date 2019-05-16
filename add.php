<?php
require_once(__DIR__ . '/inc/functions.php'); // Функции
require_once(__DIR__ . '/inc/queries.php'); // Вызовы и подключения
$configArr = require_once(__DIR__ . '/config/db.php'); // Конфигурация базы данных

$dbConnect = getConn($configArr);
$categories = getCategories($dbConnect); 

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $lot_fields = $_POST;
  $required_fields = ['lot-name', 'lot-category', 'lot-message', 'lot-rate', 'lot-step', 'lot-date']; 
  $errors = [];

  foreach ($required_fields as $field) {
    if (empty($lot_fields[$field])) {
      $errors[$field] = 'Поле обязательное для заполнения';
    }    
  }
 

  if (count($errors)) {
    $page_content = include_template('add_lot.php', [
      'categories' => $categories,
      'errors' => $errors,
      'lot_fields' => $lot_fields      
    ]);    
  } else {
    header("Location: http://yeti/lot.php");
  }
} else {
  $page_content = include_template('add_lot.php', [
    'categories' => $categories
  ]);
}

$layout_content = include_template('layout.php', [ 
  'content' => $page_content,
  'categories' => $categories,
  'title' => 'YetiCave Главная страница',
  'is_auth' => rand(0, 1),
  'user_name' => 'Сергеев Игорь'
]);

print($layout_content);



