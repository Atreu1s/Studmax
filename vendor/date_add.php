<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require_once ('connection.php');

  $born_date = mysqli_real_escape_string($conn, $_POST['born_date']);
  $born_date_formatted = date('Y-m-d', strtotime(str_replace('.', '-', $born_date)));
  $user_id = $_SESSION['user']['user_id'];

  // Добавляем проверку на правильность формата даты перед вставкой в базу данных
  $date_parts = explode('.', $born_date);
  $day = intval($date_parts[0]);
  $month = intval($date_parts[1]);
  $year = intval($date_parts[2]);

  if (!checkdate($month, $day, $year)) {
    $_SESSION['message_error'] = "Неправильный формат даты";
    header('Location: ../personal.php');
    exit;
  }

  $current_year = date('Y');
  if ($year > $current_year - 8 || $year <= 1960 || $month < 1 || $month > 12) {
    $_SESSION['message_error'] = "Неправильная дата";
    header('Location: ../personal.php');
    exit;
  }

  $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
  if ($day < 1 || $day > $days_in_month) {
    $_SESSION['message_error'] = "Неправильное число для выбранного месяца и года";
    header('Location: ../personal.php');
    exit;
  }

  // Если все проверки пройдены успешно, добавляем данные в базу данных
  $sql_data_add = "UPDATE `users` SET `age`='$born_date_formatted' WHERE id='$user_id'";
  if (mysqli_query($conn, $sql_data_add)) {
    $_SESSION['message_success'] = "Дата рождения установлена";
    $_SESSION['user']['user_age'] = $born_date;
    header('Location: ../personal.php');
    exit;
  } else {
    $_SESSION['message_error'] = "Ошибка при выполнении запроса: " . mysqli_error($conn);
    header('Location: ../personal.php');
    exit;
  }
}
?>