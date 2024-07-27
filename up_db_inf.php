<?php
// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "studmax");

// Проверка подключения
if ($conn->connect_error) {
  die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Массив требований для каждой вакансии
$requirements = array(
  "Tech Solutions Ltd.",
  "Global Innovations Inc.",
  "Digital Dynamics LLC",
  "Smart Systems Co.",
  "Infinite Insights Corp.",
  "Optimum Enterprises",
  "Creative Technologies Group",
  "Eagle Eye Solutions",
  "Pioneer Partners",
  "Future Forward Industries"
);

// Цикл от 1 до 10
for ($i = 1; $i <= 10; $i++) {
  // Запрос на обновление требований для текущей вакансии
  $sql = "UPDATE vacancies SET company  = '{$requirements[$i - 1]}' WHERE id = $i";

  // Выполнение запроса
  if ($conn->query($sql) === TRUE) {
    echo "Требования для вакансии с id $i успешно обновлены.<br>";
  } else {
    echo "Ошибка при обновлении требований: " . $conn->error . "<br>";
  }
}

// Закрытие соединения с базой данных
$conn->close();
?>