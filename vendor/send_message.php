<?php
session_start();
require_once('connection.php');

if (isset($_POST['chat_id'], $_POST['sender_id'], $_POST['message']) && isset($_SESSION['user'])) {
    $chat_id = $_POST['chat_id'];
    $sender_id = $_POST['sender_id'];
    $message = $_POST['message'];

    $insert_message_query = "INSERT INTO messages (chat_id, sender_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_message_query);
    $stmt->bind_param("iis", $chat_id, $sender_id, $message);

    if ($stmt->execute()) {
        echo "Сообщение отправлено";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
} else {
    echo "Ошибка: не переданы все необходимые данные или пользователь не авторизован.";
}
?>
