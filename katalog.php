<?php
require_once ('site_modules/header.php');
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
}

require_once ('vendor/connection.php');
require_once('site_modules/messages.php');
$result = $conn->query("SELECT * FROM vacancies");


?>
<div class="katalog_back"></div>
<?php
require_once ('site_modules/navbar.php');
?>

<section class="katalog_area">
  <div class="body_area">
    <div class="katalog_main">
      <h1>Вакансии</h1>
      <div class="katalog_flex">
        <!-- ------------ -->
        <div class="filters">
          <h2>Фильтр</h2>
          <div class="filters_area">
            <form id="filterForm">
              <h3>Образование</h3>
              <select name="education">
                <option value="">Любое</option>
                <option value="Среднее">Среднее</option>
                <option value="Среднее-специальное">Среднее-специальное</option>
              </select>
              <h3>График работы</h3>
              <select name="schedule">
                <option value="">Любой</option>
                <option value="Полный рабочий день">Полный рабочий день</option>
                <option value="Сменный график">Сменный график</option>
                <option value="Гибкий график">Гибкий график</option>
              </select>
              <h3>Зарплата</h3>
              <div><span>От:</span> <input type="number" name="min_salary"></div>
              <div><span>До:</span> <input type="number" name="max_salary"></div>
              <h3>Регион</h3>
              <select name="region">
                <option value="">Любой</option>
                <option value="Москва">Москва</option>
              </select>
              <button id="applyFilters" class="main_button_style" type="submit">Применить</button>
              <!-- Добавляем кнопку "Сбросить фильтры" -->
              <a id="resetFilters" href="?reset_filters=true"><button class="main_button_style" type="button">Сбросить
                  фильтры</button></a>
            </form>
          </div>
        </div>
        <!-- ------------ -->
        <div id="resultsArea"></div>
        <!-- ------------ -->
        <div class="kat_main" id="all_vacans">
          <div class="kat_grid">
            <?php
            // Вывод вакансий
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<div class='kat_cart'>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p class='price'>" . $row['salary'] . "</p>";
                // Если в таблице есть поля для компании и места, их нужно также вывести
                echo "<p class='company'>" . $row['company'] . "</p>";
                // Предположим, что у вас есть файл для вывода подробной информации о вакансии с названием 'vacancy.php'
                echo "<a href='vacancy.php?id=" . $row['id'] . "'>Посмотреть</a>";
                echo "</div>";
              }
            } else {
              echo "0 результатов";
            }
            ?>
          </div>
        </div>
        <!-- ------------ -->
      </div>
    </div>
  </div>
</section>
<script>
  document.getElementById("filterForm").addEventListener("submit", function(event) {
      event.preventDefault(); // Отменяем стандартное действие отправки формы

      var formData = new FormData(this); // Получаем данные формы// Отправляем AJAX запрос на сервер
      fetch('vendor/filter.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById("resultsArea").innerHTML = data; // Выводим результаты на страницу
      })
      .catch(error => console.error('Error:', error));
    });

  document.getElementById("resetFilters").addEventListener("click", function() {
  document.getElementById("filterForm").reset(); // Сброс формы

  function toggleAllVacansDisplay(displayStyle) {
        document.getElementById('all_vacans').style.display = displayStyle;
    }
});

document.getElementById("applyFilters").addEventListener("click", function() {
    var allVacans = document.getElementById("all_vacans");
    let fil_cat = document.getElementById("fil_cat");
    let resultsArea = document.getElementById("resultsArea");
    if (allVacans) {
        allVacans.style.display = "none";
        resultsArea.style.display = "block";
    }
});
document.getElementById("resetFilters").addEventListener("click", function() {
    var allVacans = document.getElementById("all_vacans");
    let fil_cat = document.getElementById("fil_cat");
    if (allVacans) {
        allVacans.style.display = "block";
        fil_cat.style.display = "none";
        resultsArea.style.display = "none";
    }
});
// document.getElementById("all_vacans").style.display = "none";
</script>
<script src="js/menu.js"></script>
<?php require_once ('site_modules/no_main_footer.php') ?>