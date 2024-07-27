<?php
session_start();
require_once('connection.php');

// Проверяем, существует ли параметр id в запросе
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Выбираем запись из таблицы job_application по id
    $select_sql = "SELECT * FROM job_application WHERE id = $id";
    $result = $conn->query($select_sql);

    if ($result && $result->num_rows > 0) {
        // Получаем данные о вакансии
        $row = $result->fetch_assoc();

        // Извлекаем данные из записи
        $title = $row['title'];
        $emp_email = $row['emp_email'];
        $company = $row['company'];
        $company_logo = $row['company_logo'];
        $salary = $row['salary'];
        $schedule = $row['schedule'];
        $education = $row['education'];
        $full_description = $row['full_description'];
        $full_requirements = $row['full_requirements'];
        $full_responsibilities = $row['full_responsibilities'];
        $full_conditions = $row['full_conditions'];
        $contacts = $row['contacts'];
        $region = $row['region'];

        // Обновляем статус в job_application на "одобрено"
        $update_status_sql = "UPDATE job_application SET status = 'одобрено' WHERE id = $id";
        if ($conn->query($update_status_sql) === TRUE) {
            // Вставляем данные в таблицу users
            $insert_sql = "INSERT INTO vacancies (title, company, company_logo, salary, schedule, education, full_description, full_requirements, full_responsibilities, full_conditions, contacts, region, emp_email) 
                          VALUES ('$title', '$company', '$company_logo', '$salary', '$schedule', '$education', '$full_description', '$full_requirements', '$full_responsibilities', '$full_conditions', '$contacts', '$region', '$emp_email')";

            if ($conn->query($insert_sql) === TRUE) {
                $_SESSION['message_success'] = "Запись успешно добавлена";
                header("Location: ../all_applications.php");
                // echo "Данные успешно перенесены в таблицу users и статус обновлен на 'одобрено'.";
            } else {
              $_SESSION['message_error'] = "Ошибка при переносе данных в таблицу users: " . $conn->error;
              header("Location: ../all_applications.php");
                echo "Ошибка при переносе данных в таблицу users: " . $conn->error;
            }
        } else {
          $_SESSION['message_error'] = "Ошибка при обновлении статуса: " . $conn->error;
          header("Location: ../all_applications.php");
            // echo "Ошибка при обновлении статуса: " . $conn->error;
        }
    } else {
      $_SESSION['message_error'] = "Запись с таким id не найдена";
        header("Location: ../all_applications.php");
        echo "Запись с таким id не найдена.";
    }
} else {
  $_SESSION['message_error'] = "Не указан id записи";
    header("Location: ../all_applications.php");
    echo "Не указан id записи.";
}

// Закрываем соединение с базой данных
$conn->close();
?>
