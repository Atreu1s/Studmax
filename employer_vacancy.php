<?php
require_once ('site_modules/header.php');
if (!isset($_SESSION['role']) && ($_SESSION['role'] != 1 || $_SESSION['role'] != 2)) {
  header("Location: index.php");
} else {
  require_once ('site_modules/navbar.php');
  require_once ('vendor/connection.php');
  ?>

  <section class="employers_main">
    <div class="body_area">
      <div class="employers_area">
        <div class="emp_form_area">
          <h2>Добавление вакансии</h2>
            <form method="post" action="vendor/vac_application.php" enctype="multipart/form-data" class="vac_form">
              <div>
                <label for="company">Компания:</label>
                <input type="text" name="company" required><br>
                
                <label for="title">Название вакансии:</label>
                <input type="text" name="title" required><br>
                
                <label for="salary">Зарплата:</label>
                <input type="text" name="salary" required><br>
                
                <label for="schedule">График работы:</label>
                <select name="schedule" class="main_input_style" required>
                    <option value="">Выберите график</option>
                    <option value="Полный рабочий день">Полный рабочий день</option>
                    <option value="Сменный график">Сменный график</option>
                    <option value="Гибкий график">Гибкий график</option>
                </select><br>
                
                <label for="education">Образование:</label>
                <select class="main_input_style"  name="education">
                    <option value="">Выберите образование</option>
                    <option value="Среднее">Среднее</option>
                    <option value="Среднее-специальное">Среднее-специальное</option>
                  </select><br>
                
                <label for="full_description">Описание:</label>
                <textarea name="full_description" required></textarea><br>
                
                <label for="full_requirements">Требования:</label>
                <textarea name="full_requirements" required></textarea><br>
              </div>
              <div>
                
                
                <label for="full_responsibilities">Обязанности:</label>
                <textarea name="full_responsibilities" required></textarea><br>
                
                <label for="full_conditions">Условия:</label>
                <textarea name="full_conditions" required></textarea><br>
                
                <label for="contacts">Контакты:</label>
                <textarea name="contacts" required></textarea><br>
                
                <label for="photo">Логотип:</label>
                <input class="emp_vac_file" type="file" name="photo" accept="image/*" required><br>
                
                <label for="region">Регион:</label>
                <select class="main_input_style" name="region" required>
                    <option value="">Выберите регион</option>
                    <option value="Москва">Москва</option>
                    <!-- <option value="Санкт-Петербург">Санкт-Петербург</option> -->
                    <!-- Добавьте другие регионы по мере необходимости -->
                </select><br>
                <label for="region">Почта</label>
                <input type="email" name="emp_email" id="emp_email">
                <button class="main_button_style" type="submit">Добавить</button>
              </div>
              
          </form>
        </div>
      </div>
    </div>
  </section>
  <script src="js/menu.js"></script>
  <?php 
  require_once('site_modules/messages.php');
  require_once ('site_modules/no_main_footer.php');
}
