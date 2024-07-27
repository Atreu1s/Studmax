<?php
// Подключение к базе данных и другие необходимые файлы
require_once('vendor/connection.php');
require_once('site_modules/header.php');
require_once('site_modules/navbar.php');
require_once('site_modules/messages.php');

// Начало сессии для доступа к данным сессии
session_start();
?>

<section class="chat-section">
    <div class="body_area">
        <h1>Чат</h1>
        <div class="chat_body">
            <div class="right_panel">
                <?php
                    $user_id = $_SESSION['user']['user_id'];
                    $sql = "
                        SELECT c.id as chat_id, u.login 
                        FROM chats c
                        JOIN users u ON (c.emp_id = $user_id AND u.id = c.user_id) OR (c.user_id = $user_id AND u.id = c.emp_id)
                        WHERE c.emp_id = $user_id OR c.user_id = $user_id
                    ";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Получение данных чата и логина
                            $chat_id = htmlspecialchars($row['chat_id']);
                            $login = htmlspecialchars($row['login']);
                            
                            // Вывод логина и ссылки для перехода
                            echo "<a href='?chat_id=$chat_id'>$login </a>";
                        }
                    } else {
                        echo "<p>У вас нет активных чатов.</p>";
                    }
                ?>
            </div>

            <div class="chat_container">
            <div class="messages"></div>
                <div class="message_send">
                    <form id="sendMessageForm" action="vendor/send_message.php" method="POST">
                        <input type="hidden" name="chat_id" value="<?php echo isset($_GET['chat_id']) ? $_GET['chat_id'] : ''; ?>">
                        <input type="hidden" name="sender_id" value="<?php echo $user_id; ?>">
                        <!-- <textarea name="message" rows="3" placeholder="Введите ваше сообщение" required></textarea> -->
                        <!-- <input class="main_input_style" type="text" name="message" placeholder="Введите ваше сообщение" required> -->
                        <textarea class="main_input_style" type="text" name="message" placeholder="Введите ваше сообщение" required></textarea>
                        <button class="main_button_style" type="submit">Отправить</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<script src="js/chat.js"></script>
<?php
require_once('site_modules/no_main_footer.php');
?>

