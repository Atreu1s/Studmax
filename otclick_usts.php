<?php
require_once('site_modules/header.php');
require_once('site_modules/messages.php');
require_once('vendor/connection.php');
require_once('site_modules/navbar.php');

// Получение id вакансии из GET-параметра
$vacancy_id = $_GET['id'];

// SQL-запрос для получения откликов на указанную вакансию
$select_otclick_sql = "SELECT otclick.*, users.fio, users.skills, users.description, users.id as user_id
                        FROM otclick 
                        JOIN users ON otclick.user_id = users.id 
                        WHERE otclick.vacancy_id = $vacancy_id";

// SQL-запрос для подсчета количества откликов на указанную вакансию
$count_otclick_sql = "SELECT COUNT(*) as count FROM otclick WHERE vacancy_id = $vacancy_id";

// Выполнение SQL-запроса для откликов
$result_otclick = $conn->query($select_otclick_sql);

// Получение количества откликов
$result_count_otclick = $conn->query($count_otclick_sql);
if ($result_count_otclick && $result_count_otclick->num_rows > 0) {
    $row = $result_count_otclick->fetch_assoc();
    $count_otclick = $row['count'];
} else {
    $count_otclick = 0;
}
?>

<section class="workers">
    <div class="body_area">
        <div class="work_area">
            <h1>Откликнувшиеся</h1>
            <div class="workers_flex">
                <?php
                // Проверка результатов запроса для откликов
                if ($result_otclick && $result_otclick->num_rows > 0) {
                    // Вывод таблицы с откликами
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr class='title'>";
                    echo "<th>№</th>";
                    echo "<th><h3>ФИО</h3></th>";
                    echo "<th>Навыки</th>";
                    echo "<th>Описание</th>";
                    echo "<th>Начать чат</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    // Цикл по результатам запроса
                    $counter = 1;
                    while ($row = $result_otclick->fetch_assoc()) {
                        // Проверяем, существует ли чат между текущим пользователем и пользователем отклика
                        $user_id = $_SESSION['user']['user_id'];
                        $other_user_id = $row['user_id'];
                        $query = "SELECT * FROM chats WHERE (emp_id = $user_id AND user_id = $other_user_id) OR (emp_id = $other_user_id AND user_id = $user_id)";
                        $result_chat = $conn->query($query);

                        if ($result_chat && $result_chat->num_rows > 0) {
                            // Если чат уже существует, выводим ссылку на chat.php
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . htmlspecialchars($row['fio']) . "</td>";
                            echo "<td>" . (isset($row['skills']) ? htmlspecialchars($row['skills']) : '') . "</td>";
                            echo "<td>" . (isset($row['description']) ? htmlspecialchars($row['description']) : '') . "</td>";
                            echo "<td><a href='chat.php?chat_id=" . $chat_id . "'>Перейти в чат</a></td>";
                            echo "</tr>";
                        } else {
                            // Если чат не существует, выводим ссылку на создание чата
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . htmlspecialchars($row['fio']) . "</td>";
                            echo "<td>" . (isset($row['skills']) ? htmlspecialchars($row['skills']) : '') . "</td>";
                            echo "<td>" . (isset($row['description']) ? htmlspecialchars($row['description']) : '') . "</td>";
                            echo "<td><a href='vendor/create_chat.php?user_id=" . $row['user_id'] . "&vacancy_id=" . $vacancy_id . "'>Начать чат</a></td>";
                            echo "</tr>";
                        }
                        $counter++;
                    }

                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>Нет откликов на данную вакансию.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php 
require_once('site_modules/no_main_footer.php');
?>
