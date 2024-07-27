<?php 
require_once('site_modules/header.php');
require_once('site_modules/messages.php');

// Начало сессии и проверка роли пользователя
session_start();
if (!isset($_SESSION['role']) && ($_SESSION['role'] != 1 || $_SESSION['role'] != 2)) {
  header("Location: index.php");
} else {
    require_once('site_modules/navbar.php');
    require_once('vendor/connection.php');
    $emp_email = $_SESSION['employer']['email'];

    // Запрос для получения заявок на добавление вакансий
    $select_sql = "SELECT id, title, status FROM job_application WHERE email='$emp_email'";
    $result = $conn->query($select_sql);

    $applications = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
    }

    // Запрос для получения вакансий
    $select_sql = "SELECT id, title FROM vacancies WHERE emp_email='$emp_email'";
    $result = $conn->query($select_sql);

    $vacancies = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $vacancies[] = $row;
        }
    }
}
?>
<section class="workers">
  <div class="body_area">
  <div class="work_area">
    <h1>Ваши вакансии</h1>
    <div class="workers_flex">
      <table>
        <thead>
          <tr class="title">
            <th><h3>ID</h3></th>
            <th>Название</th>
            <th>Откликнувшиеся</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($vacancies as $vacancy): ?>
            <tr>
              <td class="id"><?php echo htmlspecialchars($vacancy['id']); ?></td>
              <td><?php echo htmlspecialchars($vacancy['title']); ?></td>
              <td><a href="otclick_usts.php?id=<?php echo $vacancy['id']; ?>">Посмотреть</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  
</section>
<?php 
require_once('site_modules/no_main_footer.php');
?>
