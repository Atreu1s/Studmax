<?php
session_start();
require_once ('connection.php');

// Проверяем, был ли отправлен POST-запрос с идентификатором вакансии для удаления
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
  // Получаем идентификатор вакансии для удаления
  $vacancy_id = $_POST["id"];

  // Проверяем, существует ли вакансия с указанным идентификатором
  $check_vacancy_sql = "SELECT * FROM vacancies WHERE id = $vacancy_id";
  $check_vacancy_result = $conn->query($check_vacancy_sql);

  if ($check_vacancy_result && $check_vacancy_result->num_rows > 0) {
    // Вакансия существует, выполняем запрос на удаление
    $delete_vacancy_sql = "DELETE FROM vacancies WHERE id = $vacancy_id";
    if ($conn->query($delete_vacancy_sql) === TRUE) {
      // Вакансия успешно удалена
      echo json_encode(array("message" => "Вакансия успешно удалена"));
    } else {
      // Ошибка при удалении вакансии
      echo json_encode(array("error" => "Ошибка при удалении вакансии"));
    }
  } else {
    // Вакансия с указанным идентификатором не найдена
    echo json_encode(array("error" => "Вакансия с указанным идентификатором не найдена"));
  }
} else {
  // Некорректный запрос
  echo json_encode(array("error" => "Некорректный запрос"));
}
