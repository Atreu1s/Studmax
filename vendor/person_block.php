<?php
session_start();

// Подключаемся к базе данных
require_once('connection.php');

// Шаг 1: Добавить email, reason и blocked_at(время) в таблицу blocked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $reason = $_POST['reason'];
    $blocked_at = date("Y-m-d H:i:s");

    // Подготовленный запрос для вставки данных в таблицу blocked
    $sql_insert_blocked = "INSERT INTO blocked (email, reason, blocked_at) VALUES (?, ?, ?)";
    
    // Подготовленное выражение
    $stmt_insert_blocked = $conn->prepare($sql_insert_blocked);
    
    // Привязываем параметры к подготовленному выражению
    $stmt_insert_blocked->bind_param("sss", $email, $reason, $blocked_at);
    
    // Выполняем подготовленный запрос
    if ($stmt_insert_blocked->execute()) {
        // Шаг 2: Скопировать все данные из таблицы users у пользователя чей email = введенный email в таблицу blocked_users
        $sql_select_user = "SELECT * FROM users WHERE email = ?";
        
        // Подготовленное выражение для выборки пользователя
        $stmt_select_user = $conn->prepare($sql_select_user);
        
        // Привязываем параметр к подготовленному выражению
        $stmt_select_user->bind_param("s", $email);
        
        // Выполняем запрос
        $stmt_select_user->execute();
        $result = $stmt_select_user->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Добавляем пользователя в таблицу blocked_users
            $sql_insert_blocked_user = "INSERT INTO blocked_users (fio, login, email, password, phone, age, role, skills, description, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Подготовленное выражение для вставки данных в таблицу blocked_users
            $stmt_insert_blocked_user = $conn->prepare($sql_insert_blocked_user);
            
            // Привязываем параметры к подготовленному выражению
            $stmt_insert_blocked_user->bind_param("sssssissss", $row['fio'], $row['login'], $email, $row['password'], $row['phone'], $row['age'], $row['role'], $row['skills'], $row['description'], $row['profile_image']);
            
            // Выполняем запрос
            $stmt_insert_blocked_user->execute();
            
            // Шаг 3: Удалить этого пользователя из таблицы users
            $sql_delete_user = "DELETE FROM users WHERE email = ?";
            
            // Подготовленное выражение для удаления пользователя
            $stmt_delete_user = $conn->prepare($sql_delete_user);
            
            // Привязываем параметр к подготовленному выражению
            $stmt_delete_user->bind_param("s", $email);
            
            // Выполняем запрос
            $stmt_delete_user->execute();
            
            $_SESSION['message'] = "Пользователь успешно заблокирован и удален из базы данных.";
        } else {
            $_SESSION['error'] = "Пользователь с указанным email не найден в базе данных.";
        }
    } else {
        $_SESSION['error'] = "Ошибка при добавлении пользователя в таблицу blocked.";
    }
} else {
    $_SESSION['error'] = "Ошибка: Неверный метод запроса.";
}

// Закрываем подготовленные выражения
$stmt_insert_blocked->close();
$stmt_select_user->close();
$stmt_insert_blocked_user->close();
$stmt_delete_user->close();

// Закрываем соединение с базой данных
$conn->close();

// Перенаправляем пользователя обратно на страницу, с которой была отправлена форма
header("Location: ../admin_panel.php");
exit();
?>
