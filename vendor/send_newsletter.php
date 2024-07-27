<?php
session_start();
// Подключение к базе данных
require_once ('connection.php');

// Если была отправлена форма для рассылки
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Получение данных из формы
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Получение списка адресов электронной почты из базы данных
  $query = "SELECT email FROM newsletter_subscribers";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    // Отправка сообщения на каждый адрес электронной почты
    while ($row = $result->fetch_assoc()) {
      $to = $row['email'];
      $headers = 'From: studmax@mail.ru';

      // Отправка сообщения
      if (mail($to, $subject, $message, $headers)) {
        $_SESSION['message_success'] = "Сообщение успешно отправлено";
        header('Location: ../admin_panel.php');
        echo "Сообщение успешно отправлено на адрес: $to<br>";
      } else {
        echo "Ошибка при отправке сообщения на адрес: $to<br>";
      }
    }
  } else {
    echo "Нет подписчиков для отправки сообщений.";
  }

  // Закрытие соединения с базой данных
  $conn->close();
}
?>