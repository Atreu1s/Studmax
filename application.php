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
  $sql = "SELECT * FROM job_application WHERE id = $id"; // Изменено название таблицы и названия столбцов
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

              <img src="<?php echo $logo ?>" alt="company_logo">
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
            <a class="main_button_style" href="vendor/app_to_vac.php?id=<?php echo $row['id']; ?>" class="btn">Одобрить</a>

            <form class="otkaz_form" action="vendor/no_app_to_vac.php" method="post">
              <label style="display: block;" for="prichina"><h3>Причина отказа</h3></label>
              <input class="main_input_style" type="text" name="prichina">
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <input class="main_button_style" type="submit" value="Отклонить">
            </form>

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
