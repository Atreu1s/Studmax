<?php
session_start();
require_once ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Проверяем, что все необходимые поля заполнены
  if (!empty($_POST['company']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['salary']) && !empty($_POST['schedule']) && !empty($_POST['conditions']) && !empty($_POST['education']) && !empty($_POST['full_description']) && !empty($_POST['full_requirements']) && !empty($_POST['full_responsibilities']) && !empty($_POST['full_conditions']) && !empty($_POST['contacts'])) {

    // Проверяем, было ли загружено изображение
    if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
      $targetDir = "../company_logos/";

      // Генерируем уникальное имя файла
      $randomFileName = uniqid() . '_' . mt_rand() . '.' . pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
      $targetFile = $targetDir . $randomFileName;
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

      // Проверка, что файл является изображением
      $check = getimagesize($_FILES["photo"]["tmp_name"]);
      if ($check !== false) {
        $uploadOk = 1;
      } else {
        echo "Файл не является изображением.";
        $uploadOk = 0;
      }

      // Проверка размера файла
      if ($_FILES["photo"]["size"] > 5000000) {
        echo "Извините, ваш файл слишком большой.";
        $uploadOk = 0;
      }

      // Разрешенные форматы изображений
      $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
      if (!in_array($imageFileType, $allowedTypes)) {
        echo "Извините, только JPG, JPEG, PNG и GIF файлы разрешены.";
        $uploadOk = 0;
      }

      // Проверка на наличие ошибок при загрузке файла
      if ($uploadOk == 0) {
        echo "Ваш файл не был загружен.";
      } else {
        // Если всё в порядке, попытаемся загрузить файл на сервер
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
          // Файл успешно загружен, продолжаем добавление вакансии в базу данных
          $company = $_POST['company'];
          $title = $_POST['title'];
          $description = $_POST['description'];
          $salary = $_POST['salary'];
          $schedule = $_POST['schedule'];
          $conditions = $_POST['conditions'];
          $education = $_POST['education'];
          $full_description = $_POST['full_description'];
          $full_requirements = $_POST['full_requirements'];
          $full_responsibilities = $_POST['full_responsibilities'];
          $full_conditions = $_POST['full_conditions'];
          $contacts = $_POST['contacts'];
          $region = $_POST['region']; 

          $sql = "INSERT INTO vacancies (company, title, description, salary, schedule, conditions, education, full_description, full_requirements, full_responsibilities, full_conditions, contacts, company_logo, region) VALUES ('$company', '$title', '$description', '$salary', '$schedule', '$conditions', '$education', '$full_description', '$full_requirements', '$full_responsibilities', '$full_conditions', '$contacts', '$randomFileName', '$region')"; 

          if ($conn->query($sql) === TRUE) {
            $_SESSION['message_success'] = 'Вакансия успешно добавлена';
            header('Location: ../admin_panel.php');
            exit;
          } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
          }
        } else {
          echo "Произошла ошибка при загрузке вашего файла.";
        }
      }
    } else {
      echo "Файл изображения не был отправлен.";
    }
  } else {
    echo "<p class='error'>Пожалуйста, заполните все поля.</p>";
  }
}
?>