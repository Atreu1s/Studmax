<?php
require_once ('site_modules/header.php');
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
}

// if (isset($_SESSION['message'])) {
//   echo '<script>';
//   echo 'Swal.fire({';
//   echo '  title: "' . $_SESSION['message'] . '",';
//   echo '  icon: "success"';
//   echo '});';
//   echo '</script>';
//   unset($_SESSION['message']);
// }
require_once('site_modules/messages.php');
require_once ('vendor/connection.php');
?>
<script>
  function body_color() {
    document.body.style.backgroundColor = 'var(--form-text-color)';
  }
  document.addEventListener("DOMContentLoaded", body_color);

</script>

<div class="pesonal_back"></div>
<?php
require_once ('site_modules/navbar.php');
// ! перенос данных из сесси в переменные
$user_id = $_SESSION['user']['user_id'];
$user_fio = $_SESSION['user']['user_fio'];
$user_login = $_SESSION['user']['user_login'];
$user_email = $_SESSION['user']['user_email'];
$user_age = $_SESSION['user']['user_age'];
$user_phone = $_SESSION['user']['user_phone'];
if ((isset($_SESSION['user']['user_description']) || !empty($_SESSION['user']['user_description'])) && strlen($_SESSION['user']['user_description']) > 5) {
  $user_description = $_SESSION['user']['user_description'];
}
if (isset($_SESSION['user']['user_skills']) || !empty($_SESSION['user']['user_skills'])) {
  $user_skills = $_SESSION['user']['user_skills'];
}
if (isset($_SESSION['user']['profile_image']) || !empty($_SESSION['user']['profile_image'])) {
  $profile_image = $_SESSION['user']['profile_image'];
}

$emp_check = "SELECT company FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $emp_check);
if ($result) {
  // Проверка наличия данных
  if (mysqli_num_rows($result) > 0) {
      // Извлечение данных
      $row = mysqli_fetch_assoc($result);
      $company = $row['company'];
  } else {
      echo "Нет данных для данного пользователя.";
  }
} else {
  echo "Ошибка выполнения запроса: " . mysqli_error($conn);
}

?>
<script src="inputmask-phones-master/js/mask_list.js"></script>
<script src="inputmask-phones-master/js/mask.js"></script>
<section class="persinal_info">
  <div class="body_area">
    <div class="personal_area">
      <div class="personal_flex">
        <div class="media_flex">
          <div class="first_flex_personal_div">
            <form id="uploadForm" action="vendor/upload.php" method="post" enctype="multipart/form-data">
              <div class="personal_img" id="profile_img">
                <?php if (isset($_SESSION['user']['profile_image'])) { ?>
                  <img src="uploads/<?php echo $profile_image; ?>" alt="profile_img" />
                <?php } else { ?>
                  <img src="img/profile.svg" alt="profile_img" />
                <?php } ?>
                <div class="overlay" id="overlay"><span>Добавьте фото</span></div>
              </div>
              <input type="file" id="fileInput" name="image" style="display: none">
              <button class="profile_img_btn btn_chenge" id="profile_change_img" type="submit"
                style="display: none">Изменить фото</button>
            </form>
            <div class="login_email">
              <ul>
                <li><?= $user_login; ?></li>
                <li><?= $user_email; ?></li>

                <?php if (isset($_SESSION['user']['user_email'])) {
                  // require_once ('vendor/connection.php');
                  // Получаем email пользователя из сессии
                  $user_email = $_SESSION['user']['user_email'];

                  // Запрос к базе данных для проверки подписки
                  $query = "SELECT * FROM newsletter_subscribers WHERE email = '$user_email'";
                  $result = mysqli_query($conn, $query);

                  // Проверяем, есть ли подписка
                  if (mysqli_num_rows($result) > 0) {
                    // Пользователь подписан на рассылку
                
                    echo "<form style='margin: 10px 0;' action='vendor/remove_subscription.php' method='post'>";
                    echo "<button class='main_button_style' type='submit' name='unsubscribe'>Отписаться от рассылки</button>";
                    echo "</form>";
                  } else {
                    echo "<li>Вы не подписаны на нашу рассылку</li>";
                  }
                } ?>
              </ul>
            </div>
            <?php 
            if(isset($company)){
            ?>
            <div class="emp_company" style="background-color: white; border-radius: 20px; padding:20px; margin:20px 0 0 0;">
                <ul style="margin: 0px 0 0 0;">
                  <li>Коспания: <?php echo $company?></li>
                  <li><a href="emp_lich.php">Кабинет работодателя</a></li>
                </ul>
              </div>

            <?php
            } 
            ?>
          </div>

          <div class="main_inf">
            <h2><?= $user_fio; ?></h2>
            <?php 
            $status = 'Неопределен'; 
            if($_SESSION['role']==0){
              $status = 'Обычный пользователь';
            } else if($_SESSION['role']==1){
              $status = 'Работодатель';
            } else if($_SESSION['role']==2){
              $status = 'Администратор';
            } else {
              $status = 'Неопределен';
            }
            ?>
              <h3 style="margin: 10px 0 0 0;">Статус: <?php echo $status;?></h3>
            <!-- ! дата рождения -->
            <?php
            if (isset($_POST['edit_birthdate'])) {
              ?>
              <form onsubmit="return validateAndSubmit()" method="post" action="vendor/date_add.php">
                <label for="birthday">Новая дата рождения:</label>
                <input class="age_input" type="text" id="birthday" name="born_date" placeholder="дд.мм.гггг"
                  maxlength="10">

                <!-- <input class="age_input " type="date" id="birthday" name="born_date" value="<?php echo $user_age; ?>"
                  min="1950-01-01" max="<?php echo date('Y-m-d'); ?>"> -->

                <button type="submit">Сохранить</button>
              </form>

              <?php
            } else {
              if (isset($user_age) || $user_age !== NULL) {
                $birthday = new DateTime($user_age);
                $current_date = new DateTime();
                $age = $current_date->diff($birthday);
                echo '<div class="inf_div">';
                echo '<h3>Возраст: <span>' . $age->y . "</span></h3>";
                echo '<form class="change_form" method="post" action="">';
                echo '<button type="submit" name="edit_birthdate">Изменить</button>';
                echo '</form>';
                echo '</div>';
              } else {
                ?>
                <form method="post" action="vendor/date_add.php">
                  <label for="birthday">Дата рождения:</label>
                  <input class="age_input" type="text" id="birthday" name="born_date" placeholder="дд.мм.гггг"
                    maxlength="10">
                  <button type="submit">Установить</button>
                </form>

                <!-- <script src="js/date_valid.js"></script> -->
                <?php
              }

            }
            ?>
            <!-- ! номер телефона -->
            <?php
            if (isset($_POST['edit_phone'])) {

              ?>
              <div class="inf_div">
                <form method="post" action="vendor/phone_add.php">
                  <label for="phone_input">Номер телефона:</label>
                  <input class="phone_input" type="tel" id="phone_input" name="phone_number"
                    placeholder="+7(000)000-00-00">
                  <button type="submit">Установить</button>
                </form>

                <?php
            } else {

              if (isset($user_phone) || $user_phone === NULL) {
                echo '<div class="inf_div">';
                echo '<h3>Текущий номер телефона: <span>' . $user_phone . '</span></h3>';
                echo '<form class="change_form" method="post" action="">';
                echo '<button type="submit" name="edit_phone">Изменить</button>';
                echo '</form>';
                echo '</div">';
              } else {

                ?>
                  <form method="post" action="vendor/phone_add.php">
                    <label for="phone">Номер телефона:</label>
                    <input class="phone_input" type="tel" id="phone_input" name="phone_number"
                      placeholder="+7(000)000-00-00">
                    <button type="submit">Установить</button>
                  </form>
                  <?php
              }


            }
            ?>

              <div class="info_area">
                <a href="favorites.php" class="info_blocks">
                  <h3>Закладки</h3>
                  <img src="img/love.svg" alt="Закладки" />
                </a>
              </div>
              <!-- Форма для "О себе" -->
              <div class="about_inf input_profile_update">
                <h3>О себе </h3>
                <?php
                if (isset($user_description) && preg_match('/[a-zA-Zа-яА-Я]/', $user_description)) {
                  echo '<form class="form_on_php" id="edit_description_form" method="post" action="vendor/update_description.php">
                <textarea name="description" id="user_description_input" class="input_description" rows="5" cols="50" style="resize: none;" disabled placeholder="Добавьте информацию о себе">';
                  $user_description_display = ltrim(str_replace("\\r\\", "\r\n", $user_description));
                  $user_description_display = str_replace("n", "", $user_description_display);
                  echo htmlspecialchars($user_description_display);
                  echo '</textarea>
                <button type="submit" id="save_button" style="display: none;">Сохранить</button>
              </form>';
                } else {
                  echo '<form class="form_on_php" id="edit_description_form" method="post" action="vendor/update_description.php">
                <textarea name="description" id="user_description_input" class="input_description" rows="5" cols="50" style="resize: none;" disabled placeholder="Добавьте информацию о себе"></textarea>
                <button type="submit" id="save_button" style="display: none;">Сохранить</button>
              </form>';
                }
                ?>
                <div id="description_content"></div>
                <button class="btn_chenge" onclick="toggleEdit()">Изменить</button>
              </div>


              <!-- Форма для "Навыков" -->
              <div class="about_skills input_profile_update">
                <h3>Навыки</h3>
                <?php
                if (isset($user_skills) && preg_match('/[a-zA-Zа-яА-Я]/', $user_skills)) {
                  echo '
        <form class="form_on_php" id="edit_skills_form" method="post" action="vendor/update_skills.php">
            <textarea name="skills" id="user_skills_input" class="input_description" rows="5" cols="50" style="resize: none;" disabled>';
                  $user_skills_display = ltrim(str_replace("\\r\\", "\r\n", $user_skills));

                  $user_skills_display = str_replace("n", "", $user_skills_display);
                  echo htmlspecialchars($user_skills_display);
                  echo '</textarea>
            <button type="submit" id="save_skills_button" style="display: none;">Сохранить</button>
        </form>
        ';
                } else {
                  echo '<form class="form_on_php" id="edit_skills_form" method="post" action="vendor/update_skills.php">
                <textarea name="skills" id="user_skills_input" class="input_description" rows="5" cols="50" style="resize: none;" disabled placeholder="Добавьте информацию о своих навыках"></textarea>
                <button type="submit" id="save_skills_button" style="display: none;">Сохранить</button>
            </form>';
                }
                ?>
                <div id="skills_content"></div>
                <button class="btn_chenge" onclick="toggleEditSkills()">Изменить</button>
              </div>

            </div>

          </div>
          <?php
          $progress = 0;
          if (isset($user_fio)) {
            $progress += 10;
          }

          if (isset($user_login)) {
            $progress += 10;
          }

          if (isset($user_email)) {
            $progress += 10;
          }

          if (isset($user_age)) {
            $progress += 15;
          }

          if (isset($user_phone)) {
            $progress += 15;
          }
          if (isset($user_description) && preg_match('/[a-zA-Zа-яА-Я]/', $user_description)) {
            $progress += 15;
          }
          if (isset($user_skills) && preg_match('/[a-zA-Zа-яА-Я]/', $user_skills)) {
            $progress += 15;
          }
          if (isset($profile_image)) {
            $progress += 10;
          }
          ?>
          <div>
            <div class="progres_area">
              <div class="progress_bar">
                <div class="circle" data-degree="<? echo $progress; ?>" data-color="#353d60">
                  <h2 class="prosent"><? echo $progress; ?>%</h2>
                </div>
              </div>
              <h3 class="centar_h3">
                Заполненность <br />
                профиля
              </h3>
            </div>
            <div class="email_change">
              <h3 class="email_chenge_h3">Поменять почту</h3>
              <form action="vendor/email_change.php" method="post">
                <input class="main_input_style" type="email" name="new_email" placeholder="Введите новый email"
                  required>
                <button class="main_button_style" type="submit">Изменить email</button>
              </form>
            </div>
            <div class="delete_ac">
              <h3 class="email_chenge_h3">Удалить аккаунт</h3>
              <form id="deleteForm" action="vendor/delete_account.php" method="post">
                <button id="deleteButton" class="main_button_style" type="submit">Удалить</button>
              </form>
            </div>
          </div>
          <!-- !===================== -->
        </div>
      </div>
    </div>
</section>
<script>
  mask("#phone_input");
</script>
<script src="js/delete_ac.js"></script>
<script src="js/data.js"></script>
<script src="js/personal.js" defer></script>
<script src="js/menu.js"></script>
<?php require_once ('site_modules/no_main_footer.php') ?>