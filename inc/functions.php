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
