<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require_once ('connection.php');

  // Проверяем, что поле телефона было передано
  if (isset($_POST['phone_number'])) {
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    // Проверяем, что номер телефона содержит не менее 11 символов
    if (strlen($phone_number) >= 15) {
      $user_id = $_SESSION['user']['user_id'];
      $sql_phone_add = "UPDATE `users` SET `phone`='$phone_number' WHERE id='$user_id'";

      if (mysqli_query($conn, $sql_phone_add)) {
        $_SESSION['message_success'] = "Номер телефона установлен";
        $_SESSION['user']['user_phone'] = $phone_number;
        header('Location: ../personal.php');
        exit;
      } else {
        // Обработка ошибки выполнения запроса
        $_SESSION['message_error'] = "Ошибка при выполнении запроса: " . mysqli_error($conn);
        header('Location: ../error_page.php');
        exit;
      }
    } else {
      // Если номер телефона содержит менее 11 символов, отправляем обратно на страницу с формой
      $_SESSION['message_error'] = "Номер телефона должен содержать не менее 11 символов";
      header('Location: ../personal.php');
      exit;
    }
  } else {
    // Если поле телефона не было передано, отправляем обратно на страницу с формой
    $_SESSION['message_error'] = "Поле телефона не было передано";
    header('Location: ../personal.php');
    exit;
  }
}
?>