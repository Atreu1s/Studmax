<div id="app">
  <header id="header">
    <nav>
      <div class="body_area">
        <input type="checkbox" id="sidebar-active" id="sidebar-active" />
        <label for="sidebar-active" class="open-sidebar-button">
          <img src="img/menu_FILL0_wght400_GRAD0_opsz24(1).svg" alt="menugr1" />
        </label>
        <label id="overlay" for="sidebar-active"></label>
        <div class="links-container">
          <label for="sidebar-active" class="close-sidebar-button">
            <img src="img/close_FILL0_wght400_GRAD0_opsz24(1).svg" alt="menubgr2" />
          </label>
          <?php
          // ! Условия отображения меню навигации
          if (!isset($_SESSION['role'])) {
            ?>
            <p class="home-link">STUDMAX</p>
            <a href="index.php">Главная</a>
            <a href="login.php">Войти</a>
            <a href="register.php">Зарегистрироваться</a>
            <?php
          } else if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
            ?>
              <p class="home-link">STUDMAX</p>
              <a href="index.php">Главная</a>

              <a href="emp_registration.php">Работодателям</a>

              <!-- <a href="katalog.php">Вакансии</a>
              <a href="favorites.php">Избранные</a> -->
              <div class="dropdown">
                <a class="dropbtn">Вакансии</a>
                <div class="dropdown-content">
                    <a href="katalog.php">Каталог вакансий</a>
                    <a href="favorites.php">Избранные вакансии</a>
                </div>
              </div>

              <!-- <a href="personal.php">Личный кабинет</a>
              <a href="chat.php">Чат</a> -->

              <div class="dropdown">
                <a class="dropbtn">Личный кабинет</a>
                <div class="dropdown-content">
                    <a href="personal.php">Войти в личный кабинет</a>
                    <a href="chat.php">Чат</a>
                </div>
              </div>

              <a href="logout.php" id="logoutButton">Выйти</a>
            <?php
          } else if (isset($_SESSION['role']) && $_SESSION['role'] == 1){
            ?>
              <p class="home-link">STUDMAX</p>
              <a href="index.php">Главная</a>
              <!-- <a href="employer_vacancy.php">Работодателям</a>
              <a href="workers.php">Работники</a>
              <a href="emp_all_vacansy.php">Вакансии</a>
              <a href="emp_lich.php">Личный кабинет</a> -->
              <!-- <a href="chat.php">Чат</a> -->
              <div class="dropdown">
                <a class="dropbtn">Работодателям</a>
                <div class="dropdown-content">
                    <a href="employer_vacancy.php">Новая вакансия</a>
                    <a href="workers.php">Работники</a>
                    <a href="emp_lich.php">Кабинет работодателя</a>
                    <a href="emp_all_vacansy.php">Добавленные вакансии</a>
                    <a href="chat.php">Чат</a>
                </div>
              </div>
              <a href="logout.php" id="logoutButton">Выйти</a>
            <?php
          } else if (isset($_SESSION['role']) && $_SESSION['role'] == 2){
            ?>
              <p class="home-link">STUDMAX</p>
              <a href="index.php">Главная</a>
              <div class="dropdown">
                <a class="dropbtn">Работодателям</a>
                <div class="dropdown-content">
                    <a href="employer_vacancy.php">Новая вакансия</a>
                    <a href="workers.php">Работники</a>
                    <a href="emp_lich.php">Кабинет работодателя</a>
                    <a href="emp_all_vacansy.php">Добавленные вакансии</a>
                </div>
              </div>
              
              <div class="dropdown">
                <a class="dropbtn">Вакансии</a>
                <div class="dropdown-content">
                    <a href="katalog.php">Каталог вакансий</a>
                    <a href="favorites.php">Избранные вакансии</a>
                </div>
              </div>
              <!-- <a href="katalog.php">Вакансии</a>
              <a href="favorites.php">Избранные</a> -->
              <div class="dropdown">
                <a class="dropbtn">Личный кабинет</a>
                <div class="dropdown-content">
                    <a href="personal.php">Войти в личный кабинет</a>
                    <a href="chat.php">Чат</a>
                    <a href="admin_panel.php">Панель администратора</a>
                </div>
              </div>
              <!-- <a href="chat.php">Чат</a>
              <a href="personal.php">Личный кабинет</a> -->
              <!-- <a href="admin_panel.php">Панель администратора</a> -->
              <a href="logout.php" id="logoutButton">Выйти</a>
            <?php
          }
          ?>
        </div>
      </div>
    </nav>
  </header>
</div>