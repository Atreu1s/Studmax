<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require_once ('connection.php');

  $name = $_POST["fio"];
  $login = $_POST["login"];
  $password = $_POST["password"];
  $email = $_POST["email"];

  $sql_login_check = "SELECT * FROM users WHERE login='$login' ";
  $login_check_result = mysqli_query($conn, $sql_login_check);

  if (mysqli_num_rows($login_check_result) > 0) {
    $errors['login'] = "Уже есть пользователь с таким логином";
    $_SESSION['reg_errors'] = 'Уже есть пользователь с таким логином';
    header("Location: ../register.php");
  } else {

    $sql_email_check = "SELECT * FROM users WHERE email='$email' ";
    $email_check_result = mysqli_query($conn, $sql_email_check);

    if (mysqli_num_rows($email_check_result) > 0) {
      $errors['email'] = "Уже есть пользователь с такой электронной почтой";
      $_SESSION['message_error'] = 'Уже есть пользователь с такой электронной почтой';
      header("Location: ../register.php");
    } else {
      // Хешируем пароль
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Вставляем нового пользователя в базу данных
      $sql = "INSERT INTO users (fio, login, password, email) VALUES ('$name', '$login',  '$hashedPassword','$email')";
      mysqli_query($conn, $sql);

      // Редирект на главную страницу после успешной регистрации
      $_SESSION['message_success'] = "Вы успешно зарегистрированы!";
      header("Location: ../login.php");
      exit(); // Прерываем выполнение скрипта после редиректа
    }

  }
  mysqli_close($conn);
}


