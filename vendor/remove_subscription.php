<?php
session_start();
// Подключение к базе данных
require_once ('connection.php');

// Запускаем сессию


// Проверяем, была ли отправлена форма
if (isset($_POST['unsubscribe'])) {
  // Получаем email пользователя из сессии
  $user_email = $_SESSION['user']['user_email'];

  // Удаляем пользователя из таблицы подписчиков
  $query = "DELETE FROM newsletter_subscribers WHERE email = '$user_email'";
  $result = mysqli_query($conn, $query);

  // Проверяем, удалена ли запись успешно
  if ($result) {
    $_SESSION['message'] = "Вы успешно отписались от рассылки";
    // echo "<p>Вы успешно отписались от рассылки.</p>";
    header("Location: ../personal.php");
  } else {
    $_SESSION['message_error'] = "Ошибка при отписке от рассылки";
    // echo "<p>Ошибка при отписке от рассылки.</p>";
    header("Location: ../personal.php");
  }
} else {
  // Если форма не была отправлена, перенаправляем на главную страницу
  header("Location: ../personal.php");
  exit();
}