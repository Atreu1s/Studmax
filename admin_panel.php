<?php
require_once ('site_modules/header.php');
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
}

require_once ('vendor/connection.php');
if (empty($_SESSION['user']['user_id'])) {
  header("Location: index.php");
} else {
  require_once ('site_modules/navbar.php');

  ?>
<?php   require_once('site_modules/messages.php');?>
  <div class="admin_panel">
    <div class="body_area">
      <h2>Панель администратора</h2>
      <div class="admin_area">
        <button class="main_button_style" onclick="toggleForm()">Добавить вакансию</button>
        <div id="form_container" style="display: none;">
          <form method="post" action="vendor/add_vacancy.php" enctype="multipart/form-data" class="admin_form_vac">
            <label for="company">Компания:</label>
            <input class="main_input_style" type="text" id="company" name="company" required><br>
            <label for="title">Название вакансии:</label>
            <input class="main_input_style" type="text" id="title" name="title" required><br>
            <label for="salary">Зарплата:</label>
            <input class="main_input_style" type="text" id="salary" name="salary" required><br>
            <label for="schedule">График работы:</label>
            <input class="main_input_style" type="text" id="schedule" name="schedule" required><br>
            <label for="education">Образование:</label>
            <input class="main_input_style" type="text" id="education" name="education" required><br>
            <label for="full_description">Полное описание:</label>
            <textarea id="full_description" name="full_description" required></textarea><br>
            <label for="full_requirements">Требования:</label>
            <textarea id="full_requirements" name="full_requirements" required></textarea><br>
            <label for="full_responsibilities">Обязанности:</label>
            <textarea id="full_responsibilities" name="full_responsibilities" required></textarea><br>
            <label for="full_conditions">Условия:</label>
            <textarea id="full_conditions" name="full_conditions" required></textarea><br>
            <label for="contacts">Контакты:</label>
            <textarea id="contacts" name="contacts" required></textarea><br>
            <label for="photo">Фотография:</label>
            <input class="main_input_style" type="file" id="photo" name="photo" accept="image/*" required><br>
            <label for="region">Регион:</label>
            <select class="main_input_style" id="region" name="region" required>
                <option value="">Выберите регион</option>
                <option value="Москва">Москва</option>
                <option value="Санкт-Петербург">Санкт-Петербург</option>
                <!-- Добавьте другие регионы по мере необходимости -->
            </select><br>
            <input class="main_button_style" type="submit" name="submit" value="Добавить">
            <hr>
          </form>
        </div>
        <!-- ! кнопка всех вакансий -->
      <button style="display:block;" class="main_button_style" onclick="displayVacancies()">Показать все вакансии</button>
      <button class="main_button_style" onclick="hideVacancies()">Скрыть вакансии</button>
      <div id="vacancies_container" style="display: none;"></div>
      <!-- !================= -->
      <button class="main_button_style" id="openNewsletterFormBtn" onclick="toggleNewsletterForm()">Написать сообщение для рассылки</button>


      <div id="newsletterFormContainer" style="display: none;">
        <form id="newsletterForm" action="vendor/send_newsletter.php" method="post">
          <label for="subject">Тема:</label><br>
          <input type="text" id="subject" name="subject" required><br>
          <label for="message">Сообщение:</label><br>
          <textarea id="message" name="message" rows="5" required></textarea><br>
          <button class="main_button_style" type="submit">Отправить рассылку</button>
        </form>
      </div>
      <!-- !====================== -->

      <div>
        <button class="main_button_style" onclick="toggleEmailForm()">Блокировать пользователя</button>
        <div id="emailForm" style="display:none;">
          <form action="vendor/person_block.php" method="post">
            <label for="email">Email пользователя:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="reason">Причина блокировки:</label><br>
            <textarea id="reason" name="reason" rows="4" cols="50" required></textarea><br><br>
            <button class="main_button_style" type="submit">Заблокировать</button>
        </form>
      </div>
      </div>
      <a href="all_applications.php" class="main_button_style admin_link">Заявки на добавление вакансий</a>
      </div>
      
    </div>
  </div>

  <script>
    function toggleEmailForm() {
    var emailForm = document.getElementById('emailForm');
    if (emailForm.style.display === 'block') {
        emailForm.style.display = 'none';
    } else {
        emailForm.style.display = 'block';
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var deleteButton = document.getElementById("deleteButton");
    if (deleteButton) {
        deleteButton.addEventListener("click", function (event) {
            event.preventDefault();
            
            var confirmDelete = confirm("Вы уверены, что хотите заблокировать пользователя?");

            if (confirmDelete) {
                var confirmBlock = confirm("Подтвердите блокировку");

                if (confirmBlock) {
                    document.getElementById("deleteForm").submit();
                }
            }
        });
    }
});

  </script>

  <script src="js/admin.js"></script>
  <script src="js/menu.js"></script>
  <?php require_once ('site_modules/no_main_footer.php');
}
