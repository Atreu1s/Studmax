<?php
$host = 'localhost';
$user_name = 'root';
$user_pass = '';
$bd_name = 'studmax';

$conn = new mysqli($host, $user_name, $user_pass, $bd_name);

// Проверка подключения
if ($conn->connect_error) {
  die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
