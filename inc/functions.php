<?php 
//Функция шаблонизатор
function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

//Функция отображения цены
function formatPrice($num){
  $numCeil = ceil($num); 
  
  if($numCeil < 1000) {
    return $numCeil;
  }
  return number_format($numCeil, 0, '', ' '); 
}

//Фильтрация данных от XSS атак
function esc($str) {
	$text = htmlspecialchars($str);
	return $text;
}

//Расчет даты окончания лота
function lotTime(string $time){
  $lotNow = strtotime('now');
  $lotEnd =  strtotime($time);
  $lotDiff = $lotEnd  - $lotNow;
  $result = floor($lotDiff / 60); //возвращает количество минут
  return $result;  
};

//Форматирование даты
function lotTimeFormat($time){
  $hours = floor($time / 60);
  $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);

  $minutes = $time % 60;
  $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
  
  $formatDate = $hours . ':' . $minutes;
  return $formatDate;
};

/**
 * Проверяет переданную дату на соответствие формату 'ГГГГ-ММ-ДД'
 *
 * Примеры использования:
 * is_date_valid('2019-01-01'); // true
 * is_date_valid('2016-02-29'); // true
 * is_date_valid('2019-04-31'); // false
 * is_date_valid('10.10.2010'); // false
 * is_date_valid('10/10/2010'); // false
 *
 * @param string $date Дата в виде строки
 *
 * @return bool true при совпадении с форматом 'ГГГГ-ММ-ДД', иначе false
 */
function is_date_valid(string $date) : bool {
  $format_to_check = 'Y-m-d';
  $dateTimeObj = date_create_from_format($format_to_check, $date);

  return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}


/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = []) {
  $stmt = mysqli_prepare($link, $sql);

  if ($stmt === false) {
      $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
      die($errorMsg);
  }

  if ($data) {
      $types = '';
      $stmt_data = [];

      foreach ($data as $value) {
          $type = 's';

          if (is_int($value)) {
              $type = 'i';
          }
          else if (is_string($value)) {
              $type = 's';
          }
          else if (is_double($value)) {
              $type = 'd';
          }

          if ($type) {
              $types .= $type;
              $stmt_data[] = $value;
          }
      }

      $values = array_merge([$stmt, $types], $stmt_data);

      $func = 'mysqli_stmt_bind_param';
      $func(...$values);

      if (mysqli_errno($link) > 0) {
          $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
          die($errorMsg);
      }
  }

  return $stmt;
}