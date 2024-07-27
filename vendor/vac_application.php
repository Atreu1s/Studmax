<?php
session_start();


require_once('connection.php'); // Подключение к базе данных

// Получение данных из формы
$company = $_POST['company'];
$title = $_POST['title'];
$salary = $_POST['salary'];
$schedule = $_POST['schedule'];
$education = $_POST['education'];
$full_description = $_POST['full_description'];
$full_requirements = $_POST['full_requirements'];
$full_responsibilities = $_POST['full_responsibilities'];
$full_conditions = $_POST['full_conditions'];
$contacts = $_POST['contacts'];
$region = $_POST['region'];
$email = $_POST['emp_email'];

// Обработка загруженного файла (фотографии)
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
        $user_id = $_SESSION['user']['user_id'];
        // Если всё в порядке, попытаемся загрузить файл на сервер
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Файл успешно загружен на сервер, теперь можно сохранить его путь в базу данных
            // Подготовка SQL запроса для добавления данных в таблицу
            $sql = "INSERT INTO job_application (title, company, company_logo, salary, schedule, education, full_description, full_requirements, full_responsibilities, full_conditions, contacts, region, email,user_id) 
        VALUES ('$title', '$company', '$targetFile', '$salary', '$schedule', '$education', '$full_description', '$full_requirements', '$full_responsibilities', '$full_conditions', '$contacts', '$region', '$email','$user_id')";

            $emp_check = "SELECT company FROM users WHERE id='$user_id'";
            $result = mysqli_query($conn, $emp_check);

            // Проверка успешности выполнения запроса
            if ($result) {
                // Проверка наличия данных
                if (mysqli_num_rows($result) > 0) {
                    // Извлечение данных
                    $row = mysqli_fetch_assoc($result);
                    $current_company = $row['company'];

                    // Проверка, является ли текущее значение пустым
                    if (!empty($current_company)) {
                        // Если текущее значение не пустое, объединить с новым значением через запятую
                        $updated_company = $current_company . ", " . $new_company;
                    } else {
                        // Если текущее значение пустое, просто использовать новое значение
                        $updated_company = $new_company;
                    }

                    // Выполнение запроса для обновления значения столбца 'company'
                    $user_update = "UPDATE users SET company='$updated_company' WHERE id='$user_id'";
                    if (mysqli_query($conn, $user_update)) {
                        echo "Компания успешно обновлена: " . $updated_company;
                    } else {
                        echo "Ошибка обновления: " . mysqli_error($conn);
                    }
                } else {
                    echo "Нет данных для данного пользователя.";
                }
            } else {
                echo "Ошибка выполнения запроса: " . mysqli_error($conn);
            }

            // Выполнение запроса
            if ($conn->query($sql) === TRUE) {
                $_SESSION['message_success'] = "Запись успешно добавлена";
                header("Location: ../emp_lich.php");
                echo $_SESSION['message_success'];
                exit;
            } else {
                $_SESSION['message_error'] = "Ошибка: " . $sql . "<br>" . $conn->error;
                header("Location: ../emp_lich.php");
                echo "Ошибка: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $_SESSION['message_error'] = "Ошибка при загрузке файла";
            header("Location: ../emp_lich.php");
            // echo "Ошибка при загрузке файла.";
        }
    }
} else {
    $_SESSION['message_error'] = "Вы не выбрали файл для загрузки";
    header("Location: ../emp_all_vacansy.php");
    // echo "Вы не выбрали файл для загрузки.";
}

// Закрытие соединения с базой данных
$conn->close();

