<?php
session_start();
require_once ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vacancy_id'])) {
  // Получаем идентификатор вакансии из POST-запроса
  $vacancy_id = $_POST['vacancy_id'];

  // Добавляем вакансию в избранное для текущего пользователя (здесь предполагается, что у вас есть система аутентификации и вы знаете идентификатор текущего пользователя)
  $user_id = $_SESSION['user']['user_id']; // Предполагается, что вы храните идентификатор пользователя в сессии
  $sql = "INSERT INTO favorite_vacancies (user_id, vacancy_id) VALUES ('$user_id', '$vacancy_id')";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['message_success'] = "Вакансия успешно добавлена в избранное";
    header('Location: ../katalog.php');
    echo "Вакансия успешно добавлена в избранное.";
  } else {
    echo "Ошибка при добавлении вакансии в избранное: " . $conn->error;
  }
} else {
  echo "Ошибка: Не удалось обработать запрос.";
}