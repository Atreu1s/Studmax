<?php
session_start();
// Подключение к базе данных
require_once ('connection.php');

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Проверяем, есть ли пользователь в сессии

  if (isset($_SESSION['user']['user_id'])) {
    $userId = $_SESSION['user']['user_id'];

    // Удаляем пользователя из базы данных
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
      // Успешно удалено
      session_destroy(); // Очищаем сессию
      header("Location: ../index.php"); // Перенаправляем пользователя на страницу входа
      exit();
    } else {
      // Ошибка удаления
      echo "Ошибка удаления аккаунта: " . $conn->error;
    }
  }
}

