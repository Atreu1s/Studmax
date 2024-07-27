<?php
session_start();

// Подключаемся к базе данных
require_once ('connection.php');

// Обработка фильтров
$education = isset($_POST['education']) ? $_POST['education'] : '';
$schedule = isset($_POST['schedule']) ? $_POST['schedule'] : '';
$min_salary = isset($_POST['min_salary']) ? $_POST['min_salary'] : null;
$max_salary = isset($_POST['max_salary']) ? $_POST['max_salary'] : null;
$region = isset($_POST['region']) ? $_POST['region'] : '';

// Формируем SQL-запрос с учетом выбранных фильтров
$sql = "SELECT * FROM vacancies WHERE 1=1";

// Проверяем и добавляем условия фильтров
if (!empty($education)) {
  $sql .= " AND education = '$education'";
}
if (!empty($schedule)) {
  $sql .= " AND schedule = '$schedule'";
}
if (!empty($min_salary) && !empty($max_salary)) {
  $sql .= " AND salary BETWEEN '$min_salary' AND '$max_salary'";
} elseif (!empty($min_salary)) {
  $sql .= " AND salary >= '$min_salary'";
} elseif (!empty($max_salary)) {
  $sql .= " AND salary <= '$max_salary'";
}
if (!empty($region)) {
  $sql .= " AND region = '$region'";
}

// Выполнение запроса
$result = $conn->query($sql);

// Вывод вакансий
echo '<div class="kat_main">';
echo '  <div class="kat_grid">';

// Вывод вакансий
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="kat_cart" id="fil_cat">';
        echo '  <h3>' . $row['title'] . '</h3>';
        echo '  <p class="price">' . $row['salary'] . '</p>';
        // Если в таблице есть поля для компании и места, их нужно также вывести
        if (isset($row['company'])) {
            echo '  <p class="company">' . $row['company'] . '</p>';
        }
        // Предположим, что у вас есть файл для вывода подробной информации о вакансии с названием 'vacancy.php'
        echo '  <a href="vacancy.php?id=' . $row['id'] . '">Посмотреть</a>';
        echo '</div>';
    }
} else {
    echo '  0 результатов';
}

echo '  </div>';
echo '</div>';



// Закрываем соединение с базой данных
$conn->close();

