<?php
session_start();
require_once('connection.php');

if (isset($_GET['chat_id']) && isset($_SESSION['user'])) {
    $chat_id = $_GET['chat_id'];
    $current_user_id = $_SESSION['user']['user_id'];

    $get_messages_query = "
        SELECT m.message, m.sender_id, u.login AS sender_login
        FROM messages m 
        JOIN users u ON m.sender_id = u.id 
        WHERE m.chat_id = ?
        ORDER BY m.created_at ASC
    ";
    $stmt = $conn->prepare($get_messages_query);
    $stmt->bind_param("i", $chat_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($message_row = $result->fetch_assoc()) {
            $sender_id = $message_row['sender_id'];
            $sender_login = htmlspecialchars($message_row['sender_login']);
            $message = htmlspecialchars($message_row['message']);
            $sender = ($sender_id == $current_user_id) ? 'Вы' : $sender_login;
            echo "<p><strong>$sender:</strong> $message</з>";
        }
    } else {
        echo "<p>Нет сообщений в этом чате.</p>";
    }
} else {
    echo "<p>Ошибка: Не указан идентификатор чата или пользователь не авторизован.</p>";
}
?>
