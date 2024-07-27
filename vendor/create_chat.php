<?php
// Подключение к базе данных и другие необходимые файлы
require_once('connection.php');

// Проверяем, переданы ли идентификаторы пользователя и вакансии
if(isset($_GET['user_id']) && isset($_GET['vacancy_id'])) {
    $user_id = $_GET['user_id'];
    $vacancy_id = $_GET['vacancy_id'];

    // Получаем идентификатор текущего работодателя из сессии
    session_start();
    $employer_id = $_SESSION['user']['user_id']; // Предположим, что идентификатор работодателя хранится в сессии

    // Проверяем, существует ли чат с этим пользователем для текущего работодателя и вакансии
    $check_chat_query = "SELECT * FROM chats WHERE emp_id = $employer_id AND user_id = $user_id AND vacansy_id = $vacancy_id LIMIT 1";
    $check_chat_result = $conn->query($check_chat_query);

    if($check_chat_result->num_rows == 0) {
        // Если чата еще нет, создаем новый чат
        $create_chat_query = "INSERT INTO chats (emp_id, user_id, vacansy_id) VALUES ($employer_id, $user_id, $vacancy_id)";
        if($conn->query($create_chat_query) === TRUE) {
            // Чат успешно создан
            $_SESSION['message_success'] = "Чат успешно создан. Теперь вы можете начать общение.";
        } else {
            $_SESSION['message_error'] = "Ошибка при создании чата: " . $conn->error;
        }
    } else {
        // Чат уже существует
        $_SESSION['message_info'] = "Чат уже существует. Вы можете начать общение.";
        echo "123";
    }

    // Перенаправляем пользователя на страницу чата
    header("Location: ../chat.php?user_id=$user_id&vacancy_id=$vacancy_id");
    exit();
} else {
    // Если не переданы идентификаторы пользователя и вакансии, перенаправляем пользователя на страницу с ошибкой
    $_SESSION['message_error'] = "Ошибка: Не указан идентификатор пользователя или вакансии.";
    // header("Location: error.php");
    echo "1234";
    exit();
}
?>
