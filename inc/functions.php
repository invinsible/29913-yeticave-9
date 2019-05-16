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
