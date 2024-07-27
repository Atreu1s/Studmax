<?php
session_start();
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vacancy_id']) && isset($_POST['user_id'])) {
    // Получаем идентификаторы вакансии и пользователя из POST-запроса
    $vacancy_id = $_POST['vacancy_id'];
    $user_id = $_POST['user_id'];

    // Вставляем отклик в таблицу otclick
    $sql = "INSERT INTO otclick (user_id, vacancy_id) VALUES ('$user_id', '$vacancy_id')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message_success'] = "Вы успешно откликнулись на вакансию";
        header('Location: ../katalog.php');
        exit();
    } else {
        echo "Ошибка при отклике на вакансию: " . $conn->error;
    }
} else {
    echo "Ошибка: Не удалось обработать запрос.";
}

// Закрываем соединение с базой данных
$conn->close();
?>
