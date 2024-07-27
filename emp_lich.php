<?php 
require_once('site_modules/header.php');

// Начало сессии и проверка роли пользователя
session_start();
if (!isset($_SESSION['role']) && ($_SESSION['role'] != 1 || $_SESSION['role'] != 2)) {
  header("Location: index.php");
} else {
    require_once('site_modules/navbar.php');
    require_once('vendor/connection.php');
    $user_id = $_SESSION['user']['user_id'];
    $select_sql = "SELECT company, email, phone, role FROM users WHERE id='$user_id'";
    $result = $conn->query($select_sql);

    $employers = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employers[] = $row;
        }
    }

    $select_sql = "SELECT id, title, status FROM job_application WHERE user_id='$user_id'";
    $result = $conn->query($select_sql);

    $applications = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
    }

    // Добавление запроса для получения отклоненных вакансий
    $select_sql = "SELECT app_id, description FROM no_add_vac WHERE user_id='$user_id'";
    $result = $conn->query($select_sql);

    $rejected_applications = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rejected_applications[] = $row;
        }
    }
}
?>
<section class="employers">
  <div class="body_area">
    <div class="work_area">
      <h1>Личный кабинет работодателя</h1>
      <div class="employers_flex">
        <?php foreach ($employers as $employer): ?>
          <div class="employer">
            <h3><strong>Компания:</strong> <?php echo htmlspecialchars($employer['company']); ?></h3>
            <h3><strong>Email:</strong> <?php echo htmlspecialchars($employer['email']); ?></h3>
            <h3><strong>Телефон:</strong> <?php echo htmlspecialchars($employer['phone']); ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <section class="workers">
    <div class="body_area">
      <div class="work_area">
        <h1>Ваши заявки на добавление вакансии</h1>
        <div class="workers_flex">
          <table>
            <thead>
              <tr class="title">
                <th><h3>ID</h3></th>
                <th>Название</th>
                <th>Статус</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($applications as $application): ?>
                <tr>
                  <td class="id"><?php echo htmlspecialchars($application['id']); ?></td>
                  <td><?php echo htmlspecialchars($application['title']); ?></td>
                  <td><?php echo htmlspecialchars($application['status']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="rejected_applications">
    <div class="body_area">
      <div class="work_area">
        <h1>Отклонённые вакансии</h1>
        <div class="workers_flex">
          <table>
            <thead>
              <tr class="title">
                <th><h3>ID заявки</h3></th>
                <th>Причина отказа</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rejected_applications as $rejected): ?>
                <tr>
                  <td class="app_id"><?php echo htmlspecialchars($rejected['app_id']); ?></td>
                  <td><?php echo htmlspecialchars($rejected['description']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</section>
<?php 
require_once('site_modules/no_main_footer.php');
?>
