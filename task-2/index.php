<?php

require_once 'includes/ApiClient.php';
require_once 'includes/Database.php';

$dbHost = 'localhost';
$dbName = 'test_db';
$dbUser = 'root';
$dbPass = '';

$database = new Database($dbHost, $dbName, $dbUser, $dbPass);
$apiClient = new ApiClient('https://jsonplaceholder.typicode.com/todos');

try {
    $data = $apiClient->fetchData();
    $database->insertData($data);

    echo 'Данные успешно сохранены в базе данных.';
} catch (\Exception $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

?>
