<?php 

// Подключение к базе данных
function getConn($configArr) {    
    $dbConnect = mysqli_connect($configArr['host'], $configArr['user'], $configArr['password'], $configArr['database']);
    mysqli_set_charset($dbConnect, "utf8");
    if (!$dbConnect) {
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());         
    }
    return $dbConnect;
}

// Формирование результата из запросов в базе данных
function getResult($dbConnect, $sql) {
    $result = mysqli_query($dbConnect, $sql);
    if (!$result) {
        print("Ошибка MySQL: " . mysqli_error($dbConnect)); 
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Запрос списка категорий
function getCategories($dbConnect) {
    $sql = "SELECT * FROM categories"; 
    return getResult($dbConnect, $sql);  
}

// Запрос списка лотов
function getLots($dbConnect) {
    $sql = "SELECT lots.name AS lot_name, categories.name AS cat_name, lots.id AS lot_id, price, img, date_end FROM lots INNER JOIN categories ON lots.category_id = categories.id WHERE date_end >= NOW()";
    return getResult($dbConnect, $sql);
}

