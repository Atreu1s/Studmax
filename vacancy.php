<?php
require_once ('site_modules/header.php');
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
}

require_once ('vendor/connection.php');
require_once ('site_modules/navbar.php');
?>
<div class="vaca_back"></div>
<?php
// Проверяем наличие параметра id в URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  // Запрос к базе данных для получения информации о вакансии с заданным id
  $sql = "SELECT * FROM vacancies WHERE id = $id";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    // Выводим информацию о вакансии
    $row = $result->fetch_assoc();
    ?>
    
    <div class="click_var_main">
      <div class="body_area">
        <div class="click_var_area">
          <div class="vac_flex_start">
            <div>
              <h2><?php echo $row['company']; ?></h2>
              <h3 class="vac-vac"><?php echo "Вакансия: " . $row['title']; ?></h3>
              <div class="vac_flex_grup">
                <div class="vac_group">
                  <div class="flex_vac_div">
                    <h3 class="dot_text">Зарплата:</h3>
                    <p><?php echo $row['salary']; ?> рублей</p>
                  </div>
                  <div class="flex_vac_div">
                    <h3 class="dot_text">График работы:</h3>
                    <p><?php echo $row['schedule']; ?></p>
                  </div>
                  <div class="flex_vac_div">
                    <h3 class="dot_text">Образование:</h3>
                    <p><?php echo $row['education']; ?></p>
                  </div>
                </div>
                <div class="vac_group con-vac">
                  <h3>Контакты</h3>
                  <p><?php echo nl2br($row['contacts']); ?></p>
                </div>
              </div>
              <!-- ! ========================= -->
            </div>
            <!-- ! ========================= -->
            <div class="vac_company_logo">
              <?php $logo = $row['company_logo']; ?>

              <img src="company_logos/<?php echo $logo ?>" alt="company_logo">
            </div>
            <!-- ! =================== -->
          </div>
          <div class="vac_large_div first_large_div">
            <h3>Описание</h3>
            <p><?php echo $row['full_description']; ?></p>
          </div>
          <div class="vac_large_div">
            <h3>Требования</h3>
            <p><?php echo $row['full_requirements']; ?></p>
          </div>
          <div class="vac_large_div">
            <h3>Обязанности</h3>
            <p><?php echo $row['full_responsibilities']; ?></p>
          </div>
          <div class="vac_large_div">
            <h3>Условия</h3>
            <p><?php echo $row['full_conditions']; ?></p>
          </div>

          <div class="buttons_vac_large">
            <?php
            // Проверяем, добавлена ли вакансия в избранное
            $check_favorite_sql = "SELECT * FROM favorite_vacancies WHERE user_id = {$_SESSION['user']['user_id']} AND vacancy_id = $id";
            $check_favorite_result = $conn->query($check_favorite_sql);
            if ($check_favorite_result && $check_favorite_result->num_rows > 0) {
              ?>
              <form method="post" action="vendor/remove_from_favorites.php">
                <input type="hidden" name="vacancy_id" value="<?php echo $id; ?>">
                <button type="submit">Удалить из избранного</button>
              </form>
              <?php
            } else {
              ?>
              <form method="post" action="vendor/add_to_favorites.php">
                <input type="hidden" name="vacancy_id" value="<?php echo $id; ?>">
                <button type="submit">Добавить в избранное</button>
              </form>
              <form method="post" action="vendor/otclick.php" style="margin: 10px 0;">
                <input type="hidden" name="vacancy_id" value="<?php echo $id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id']; ?>">
                <button type="submit">Откликнуться</button>
              </form>
              <?php
            }
            ?>

          </div>
        </div>
      </div>
    </div>
    <?php
  } else {
    echo "Вакансия не найдена.";
  }
} else {
  echo "Не удалось получить информацию о вакансии.";
}
?>

<script src="js/menu.js"></script>
<?php require_once ('site_modules/no_main_footer.php') ?>