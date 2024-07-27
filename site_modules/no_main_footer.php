
<footer class="no_main_footer">
  <div class="body_area">
    <div class="footer_flex">
      <div class="foot_flex_first">
        <a href="index.php">Главная</a>
        <a href="personal.php">Личный кабинет</a>
        <a href="login.php">Войти</a>
        <a href="register.php">Зарегистрироваться</a>
      </div>
      <div>
        <img src="img/logoLihtblue.svg" alt="footerLogo" />
        <a href="../files/politica.docx" download>Политика конфиденциальности</a>
        <a href="../files/pravila.docx" download>Правила поведения</a>
        
      </div>
      <div class="news_mail">
        <h3>Подписка на рассылку</h3>
        <p>Получайте уведомления о новых подходящих вакансиях</p>
        <form action="vendor/email_newsletter.php" method="post">
          <input type="email" name="emailF" id="emailF" placeholder="Email" <?php if (isset($_SESSION['user']))
            echo 'value="' . $_SESSION['user']['user_email'] . '"'; ?> required />
          <button type="submit">Подписаться</button>
        </form>
        <p>Заполняя форму, Вы соглашаетесь с политикой конфиденциальности</p>
      </div>
    </div>
  </div>
</footer>
<script src="js/exit.js"></script>

</body>

</html>
<?php
require_once('modals.php');
require_once('messages.php');

?>