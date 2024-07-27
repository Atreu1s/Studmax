<?php
require_once ('site_modules/header.php');
require_once ('vendor/connection.php');
require_once ('site_modules/navbar.php');

require_once('site_modules/messages.php');
// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user']['user_id'])) {
  header("Location: login.php");
  exit;
}
?>
<div class="vaca_back"></div>
<?php
// Получаем ID пользователя
$user_id = $_SESSION['user']['user_id'];

// Запрос к базе данных для получения избранных вакансий пользователя
$sql = "SELECT * FROM favorite_vacancies WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  ?>
  <div class="fav_vac_main">
    <div class="body_area">
      <h1>Избранные вакансии</h1>
      <div class="fav_vac_area">
        <div class="kat_grid">
          <?php
          // Выводим информацию о каждой избранной вакансии
          while ($row = $result->fetch_assoc()) {
            $vacancy_id = $row['vacancy_id'];
            $vacancy_sql = "SELECT * FROM vacancies WHERE id = $vacancy_id";
            $vacancy_result = $conn->query($vacancy_sql);
            if ($vacancy_result && $vacancy_result->num_rows > 0) {
              $vacancy_row = $vacancy_result->fetch_assoc();
              ?>

              <div class="kat_cart">
                <h3><?php echo $vacancy_row['title']; ?></h3>
                <p class="price"><?php echo $vacancy_row['salary']; ?></p>
                <p class="company"><?php echo $vacancy_row['company']; ?></p>
                <a href="vacancy.php?id=<?php echo $vacancy_id; ?>">Посмотреть</a>
              </div>

              <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
} else {
  ?>
  <div class="fav_vac_main">
    <div class="body_area">
      <h1>Избранные вакансии</h1>
      <h2 style="margin: 0 0 0 10px;">У вас пока нет избранных вакансий</h2>
    </div>
  </div>
  <?php
}

require_once ('site_modules/no_main_footer.php');
?>