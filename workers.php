<?php 
require_once('site_modules/header.php');

// Начало сессии и проверка роли пользователя
session_start();
if (!isset($_SESSION['role']) && ($_SESSION['role'] != 1 || $_SESSION['role'] != 2)) {
  header("Location: index.php");
} else {
    require_once('site_modules/navbar.php');
    require_once('vendor/connection.php');

    $select_sql = "SELECT * FROM users WHERE role <> 2";
    $result = $conn->query($select_sql);

    $workers = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $workers[] = $row;
        }
    }
}
?>
<section class="workers">
  <div class="body_area">
    <div class="work_area">
      <h1>Работники</h1>
      <div class="workers_flex">
        <table>
          <thead>
            <tr class="title">
              <th><h3>ФИО</h3></th>
              <th>Навыки</th>
              <th>О себе</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($workers as $worker): ?>
              <tr>
                <td class="fio"><h3><?php echo htmlspecialchars($worker['fio']); ?></h3></td>
                <td><?php echo !empty($worker['skills']) ? htmlspecialchars($worker['skills']) : 'Навыки не указаны'; ?></td>
                <td><?php echo !empty($worker['description']) ? htmlspecialchars($worker['description']) : 'Описание не указано'; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?php 
require_once('site_modules/no_main_footer.php')
?>
