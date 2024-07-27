<?php
// Подключение к базе данных
require_once ('connection.php');

// Запускаем сессию
session_start();

// Проверяем, был ли отправлен новый email
if (isset($_POST['new_email'])) {
  // Получаем новый email из формы
  $new_email = $_POST['new_email'];

  // Получаем id пользователя из сессии
  $user_id = $_SESSION['user']['user_id'];

  // Обновляем email пользователя в базе данных
  $query = "UPDATE users SET email = '$new_email' WHERE id = '$user_id'";
  $result = mysqli_query($conn, $query);

  // Проверяем, успешно ли обновлен email
  if ($result) {
    // Обновляем email в сессии
    $_SESSION['user']['user_email'] = $new_email;
    $_SESSION['message'] = "Email успешно изменен";
    // echo "<p>Email успешно изменен.</p>";
    header("Location: ../personal.php");
  } else {
    $_SESSION['message_error'] = "Ошибка при изменении email";
    // echo "<p>Ошибка при изменении email.</p>";
    header("Location: ../personal.php");
  }
} else {
  // Если форма не была отправлена, перенаправляем на главную страницу
  header("Location: ../personal.php");
  exit();
}
?>