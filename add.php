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

  if (!(is_numeric($lot_fields['lot-rate']) && $lot_fields['lot-rate'] > 0)){
    $errors['lot-rate'] = 'Введите число больше 0';
  }
  if (!(is_numeric($lot_fields['lot-step']) && ctype_digit($lot_fields['lot-step']) > 0)){    
    $errors['lot-step'] = 'Введите целое число больше 0';
  }
  if (!is_date_valid($lot_fields['lot-date'])){
    $errors['lot-date'] = 'Введите дату в формате ГГГГ-ММ-ДД';
  }
  if (strtotime($lot_fields['lot-date']) - time() <= 86400) {
    $errors['lot-date'] = 'Продлите срок действия лота';
  }
  if (isset($_FILES['lot-img'])) {
    $file_name = $_FILES['lot-img']['name'];
    $file_path = __DIR__ . '/uploads/';
    $file_url = '/uploads/' . $file_name;
    move_uploaded_file($_FILES['lot-img']['tmp_name'], $file_path . $file_name);   
  } else {
    $errors['lot-img'] = 'Файл не загружен';
  }

  foreach ($required_fields as $field) {
    if (empty($lot_fields[$field])) {
      $errors[$field] = 'Поле не заполнено';
    }    
  }

  if (count($errors)) {
    $page_content = include_template('add_lot.php', [
      'categories' => $categories,
      'errors' => $errors,
      'lot_fields' => $lot_fields      
    ]);    
  } else {
    $sql = 'INSERT INTO lots (date_create, lots.name, lots.description, lots.img, lots.price, date_end, category_id, user_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, 1)';

    $stmt = db_get_prepare_stmt($dbConnect, $sql, [$lot_fields['lot-name'], $lot_fields['lot-message'], $file_url, $lot_fields['lot-rate'], $lot_fields['lot-date'], $lot_fields['lot-category']]); 
    $res = mysqli_stmt_execute($stmt);
      if ($res) {
          $lot_id = mysqli_insert_id($dbConnect);

          header("Location: lot.php?pageId=" . $lot_id);
      }
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



