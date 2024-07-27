<?php
session_start();
// Подключение к базе данных
require_once ('connection.php');

// Проверка подключения
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Проверяем, была ли отправлена форма подписки
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Получаем email из формы
  if (isset($_SESSION['user']['user_id'])) {
    $email = $_POST['emailF'];
    $stmt = $conn->prepare("SELECT * FROM newsletter_subscribers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $_SESSION['message_success'] = "Вы уже подписаны";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      // Записи с таким email нет, можно выполнить вставку
      $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $_SESSION['message_success'] = "Вы успешно подписались на рассылку";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      // echo "Пользователь успешно подписан на рассылку.";
    }

    $stmt->close();
    $conn->close();
  } else {
    $_SESSION['message_error'] = "Вы не авторизованы";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }
}

