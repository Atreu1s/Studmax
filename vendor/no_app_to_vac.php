<?php
session_start();
require_once('connection.php');

// Проверяем, существует ли параметр id в запросе
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
  $id = $_POST['id'];

    // Проверяем, была ли отправлена форма с причиной отказа
    if (isset($_POST['prichina']) && !empty($_POST['prichina'])) {
        $prichina = $_POST['prichina'];

        // Выбираем запись из таблицы job_application по id
        $select_sql = "SELECT * FROM job_application WHERE id = $id";
        $result = $conn->query($select_sql);

        if ($result && $result->num_rows > 0) {
            // Получаем данные о вакансии
            $row = $result->fetch_assoc();

            // Извлекаем данные из записи
            $emp_email = $row['emp_email']; // Предполагаем, что email работодателя хранится в contacts
            $app_id = $id;

            // Обновляем статус в job_application на "отклонено"
            $update_status_sql = "UPDATE job_application SET status = 'отклонено' WHERE id = $id";
            if ($conn->query($update_status_sql) === TRUE) {
                // Вставляем данные в таблицу no_add_vac
                $insert_sql = "INSERT INTO no_add_vac (emp_email, description, app_id) 
                              VALUES ('$emp_email', '$prichina', '$app_id')";

                if ($conn->query($insert_sql) === TRUE) {
                    $_SESSION['message_success'] = "Запись успешно отклонена";
                    header("Location: ../all_applications.php");
                } else {
                    $_SESSION['message_error'] = "Ошибка при переносе данных в таблицу: " . $conn->error;
                    header("Location: ../all_applications.php");
                }
            } else {
                $_SESSION['message_error'] = "Ошибка при обновлении статуса: " . $conn->error;
                header("Location: ../all_applications.php");
            }
        } else {
            $_SESSION['message_error'] = "Запись с таким id не найдена";
            header("Location: ../all_applications.php");
        }
    } else {
        $_SESSION['message_error'] = "Причина отказа не указана";
        header("Location: ../all_applications.php");
    }
} else {
    $_SESSION['message_error'] = "Не указан id записи";
    header("Location: ../all_applications.php");
}

// Закрываем соединение с базой данных
$conn->close();
?>
