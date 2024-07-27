<?php
session_start();
require_once ('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // Проверка наличия данных и минимальной длины для описания
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $user_id = $_SESSION['user']['user_id'];

  $sql_update_description = "UPDATE `users` SET `description`='$description' WHERE id='$user_id'";

  if (mysqli_query($conn, $sql_update_description)) {
    // Обработка успешного выполнения запроса
    $_SESSION['message_success'] = "Описание успешно обновлено";
    $_SESSION['user']['user_description'] = $description;
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