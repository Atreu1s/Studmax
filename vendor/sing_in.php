<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require_once ('connection.php');

  $login = mysqli_real_escape_string($conn, $_POST['login']);
  $password = mysqli_real_escape_string($conn, $_POST['logpassword']);

  $login_search = "SELECT * FROM users WHERE login='$login'";
  $login_search_result = mysqli_query($conn, $login_search);
  $user = mysqli_fetch_assoc($login_search_result);

  if ($user) {
    // Проверяем введенный пароль с хешем пароля из базы данных
    if (password_verify($password, $user['password'])) {
      // Если пароль верный, устанавливаем сессионные переменные и перенаправляем на главную страницу
      $_SESSION['role'] = $user['role'];
      $_SESSION['user'] = [
        'user_id' => $user['id'],
        'user_login' => $login,
        'user_email' => $user['email'],
        'user_fio' => $user['fio'],
        'user_phone' => $user['phone'],
        'user_age' => $user['age'],
        'user_description' => $user['description'],
        'user_skills' => $user['skills'],
        'profile_image' => $user['profile_image'],
      ];
      $_SESSION['message_success'] = "Вы успешно авторизованы!";
      header('Location: ../index.php');
      exit;
    } else {
      header("Location: ../index.php");
      $_SESSION['message_error'] = 'Неверный пароль';
      echo 'Ошибка: Неверный пароль';
    }
  } else {
    header("Location: ../index.php");
    $_SESSION['message_error'] = 'Неверное имя пользователя';
    echo 'Ошибка: Неверное имя пользователя ';
  }
}