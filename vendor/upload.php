<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require_once ('connection.php');

  // Проверяем, был ли отправлен файл изображения
  if (isset($_FILES["image"])) {
    // Обработка загрузки изображения
    $targetDir = "../uploads/";

    // Генерируем уникальное имя файла
    $randomFileName = uniqid() . '_' . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $randomFileName;

    // Проверяем, является ли файл изображением
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      echo "Файл не является изображением.";
      $uploadOk = 0;
    }

    // Проверяем размер файла
    if ($_FILES["image"]["size"] > 5000000) {
      echo "Извините, ваш файл слишком большой.";
      $uploadOk = 0;
    }

    // Разрешаем только определенные форматы файлов
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $allowedTypes)) {
      echo "Извините, только JPG, JPEG, PNG и GIF файлы разрешены.";
      $uploadOk = 0;
    }

    // Проверяем $uploadOk на наличие ошибок
    if ($uploadOk == 0) {
      echo "Ваш файл не был загружен.";
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Файл успешно загружен на сервер

        // Обновляем информацию о профиле пользователя в базе данных
        $user_id = $_SESSION['user']['user_id'];
        $sql_update_image = "UPDATE `users` SET `profile_image` = '$randomFileName' WHERE `id`='$user_id'";

        if (mysqli_query($conn, $sql_update_image)) {
          // Обновление выполнено успешно
          $_SESSION['message_success'] = "Изображение профиля успешно обновлено";
          $_SESSION['user']['profile_image'] = $randomFileName;
          header('Location: ../personal.php');
          exit;
        } else {
          // Ошибка при обновлении информации в базе данных
          $_SESSION['message_error'] = "Ошибка при обновлении информации в базе данных: " . mysqli_error($conn);
          header('Location: ../personal.php');
          exit;
        }
      } else {
        // Ошибка при загрузке файла на сервер
        echo "Произошла ошибка при загрузке вашего файла.";
      }
    }
  } else {
    echo "Файл изображения не был отправлен.";
  }
}
?>