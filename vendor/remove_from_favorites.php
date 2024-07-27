<?php
session_start();
require_once ('connection.php'); // Подключение к базе данных

// Проверяем, был ли передан идентификатор вакансии для удаления из избранного
if (isset($_POST['vacancy_id']) && is_numeric($_POST['vacancy_id'])) {
  $vacancy_id = $_POST['vacancy_id'];
  $user_id = $_SESSION['user']['user_id']; // Получаем идентификатор пользователя из сессии

  // Запрос на удаление вакансии из избранного
  $delete_sql = "DELETE FROM favorite_vacancies WHERE user_id = $user_id AND vacancy_id = $vacancy_id";

  if ($conn->query($delete_sql) === TRUE) {
    // Вакансия успешно удалена из избранного
    header("Location: ../favorites.php"); // Перенаправляем пользователя на страницу избранных вакансий
    exit();
  } else {
    // Возникла ошибка при удалении вакансии из избранного
    echo "Ошибка: " . $conn->error;
  }
} else {
  // Если идентификатор вакансии не был передан или передан некорректно
  echo "Некорректный запрос";
}

$conn->close(); // Закрываем соединение с базой данных
