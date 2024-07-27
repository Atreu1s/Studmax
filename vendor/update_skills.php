<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require_once ('connection.php');

  // Проверка наличия данных и минимальной длины для навыков
  $skills = mysqli_real_escape_string($conn, $_POST['skills']);
  $user_id = $_SESSION['user']['user_id'];

  $sql_update_skills = "UPDATE `users` SET `skills`='$skills' WHERE id='$user_id'";

  if (mysqli_query($conn, $sql_update_skills)) {
    // Обработка успешного выполнения запроса
    $_SESSION['message_success'] = "Навыки успешно обновлены";
    $_SESSION['user']['user_skills'] = $skills;
    header('Location: ../personal.php');
    exit;
  } else {
    // Обработка ошибки выполнения запроса
    $_SESSION['message_error'] = "Ошибка при выполнении запроса: " . mysqli_error($conn);
    header('Location: ../personal.php');
    exit;
  }
}
?>