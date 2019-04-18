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