<?php require_once ('site_modules/header.php'); ?>
<div class="formBacktop"></div>
<?php require_once ('site_modules/navbar.php');
require_once('site_modules/messages.php');

?>

<section class="mainForm">
  <div class="bodu_area">
    <div class="form_flex">
      <!-- ! ======================== -->
      <div class="regInfo" id="regInfo">
        <div>
          <h2 class="reg_h2">Создайте свой аккаунт</h2>
          <p class="form_p1">И найдите работу вместе с STUDMAX</p>
          <p class="form_p2">Уже есть аккаунт?</p>
          <button type="button" id="loginBtn">Войти</button>
        </div>
      </div>
      <!-- ! ======================== -->
      <div class="form_area regForm" id="regForm">
        <h2>Регистрация</h2>
        <form method="post" action="vendor/sing_up.php">
          <input type="text" name="fio" id="fio" placeholder="ФИО" autocomplete="given-name" required />
          <span id="fio_message" style="display:none;"></span>
          <input type="text" name="login" id="login" placeholder="Логин" autocomplete="nickname" required />
          <div class="password-input-container">
            <input type="password" id="regpassword" name="password" placeholder="Password" required>
            <button type="button" id="toggleRegPassword" class="password-toggle"></button>
          </div>
          <span id="pass_span"></span>

          <div class="password-input-container">
            <input type="password" id="regpassword_check" name="password_check" placeholder="Repeat Password" required>
            <button type="button" id="toggleRegPasswordCheck" class="password-toggle"></button>
          </div>
          <span id="pass_span_check" style="font-size=18px color=red"></span>
          <input type="email" name="email" id="email" placeholder="Email" required />
          <span id="email_massage"></span>
          <button id="register_button" type="submit">Зарегистрироваться</button>
        </form>
        <div class="phone_link">
          <p>Уже есть аккаунт? <a href="login.html">Войти</a></p>
        </div>
      </div>
      <!-- ! ======================== -->
      <div class="form_area authForm min_screen" id="logForm">
        <h2>Авторизация</h2>
        <form action="vendor/sing_in.php" method="post" autocomplete="on">

          <input type="text" name="login" id="login" placeholder="Логин" autocomplete="nickname" required />
          <div class="password-input-container">
            <input type="password" name="logpassword" id="loginPasswordInput" placeholder="Пароль"
              autocomplete="current-password" required />
            <button type="button" id="toggleLoginPassword" class="password-toggle"></button>
          </div>
          <span class="back_acc"><a href="password_recovery.php">Восстановить пароль</a></span>
          <button type="submit">Войти</button>

          <div class="phone_link">
            <p>
              Нет аккаунта? <a href="register.html">Зарегистрироваться</a>
            </p>
          </div>
        </form>
      </div>
      <!-- ! ======================== -->
      <div class="logInfo authInfo min_screen" id="logInfo">
        <div>
          <h2 class="log_h2">Рады видеть Вас</h2>
          <p class="form_p1">Мы уже подобрали лучшие вакансии</p>
          <p class="form_p2">Впервые здесь?</p>
          <button type="button" id="regBtn">Зарегистрироваться</button>
        </div>
      </div>
      <!-- ! ======================== -->
    </div>
  </div>
</section>
<script src="js/form_validation.js"></script>
<script src="js/form_reverse.js" defer></script>
<script src="js/swipe.js" defer></script>
<script src="js/menu.js" defer></script>
<?php require_once ('site_modules/no_main_footer.php') ?>