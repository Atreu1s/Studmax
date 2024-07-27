<?php
require_once ('site_modules/header.php');
// Database connection
require_once ('vendor/connection.php');
require_once ('site_modules/navbar.php');

require_once('site_modules/messages.php');
// Function to generate a random 6-digit code
function generateCode()
{
  return mt_rand(100000, 999999);
}

// Function to send email
function sendEmail($to, $subject, $message)
{
  $headers = "From: your_email@example.com" . "\r\n" .
    "Reply-To: your_email@example.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

  // Send email
  if (mail($to, $subject, $message, $headers)) {
    return true; // Email successfully sent
  } else {
    return false; // Email sending failed
  }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // If the form is submitted for password recovery
  if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
      // Generate a unique 6-digit code
      $code = generateCode();

      // Save code and email in session
      $_SESSION['recovery_code'] = $code;
      $_SESSION['recovery_email'] = $email;

      // Send the code to the user's email
      $subject = "Password Recovery Code";
      $message = "Your recovery code is: $code";
      sendEmail($email, $subject, $message);

      // Redirect to the same page to proceed to the next step
      header("Location: password_recovery.php");
      exit;
    } else {
      $error = "Email not found";
    }
  }

  // If the form is submitted for code verification
  if (isset($_POST['confirm_code'])) {
    $code = $_POST['confirm_code'];
    $_SESSION['confirm_code'] = $code;
    // Проверяем, соответствует ли введенный код коду восстановления
    if ((int) $_SESSION['recovery_code'] === (int) $code) {
      // Устанавливаем метку, что код был подтвержден верно
      $_SESSION['code_verified'] = true;
      // Перенаправляем на форму обновления пароля
      header("Location: password_recovery.php");
      exit;
    } else {
      // Перенаправляем с ошибкой, если код неверный
      header("Location: password_recovery.php?error=Invalid code");
      exit;
    }
  }

  // If the form is submitted for password update
  if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password === $confirm_password) {
      // Update the password in the database
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
      $stmt->bind_param("ss", $hashed_password, $_SESSION['recovery_email']);
      if ($stmt->execute()) {
        // Redirect to a success page
        header("Location: login.php");
        exit;
      } else {
        $error = "Error updating password";
      }
    } else {
      $error = "Passwords do not match";
    }
  }
}

// Если нажата кнопка "Отмена", очищаем сессию и перенаправляем на страницу login.php
if (isset($_POST['cancel'])) {
  $_SESSION = array(); // Очищаем сессию
  // session_unset();
  session_destroy();
  header("Location: login.php");
  exit;
}
?>

<section class="pass_recovery">
  <div class="body_area">
    <div class="pass_rec_area">
      <div>
        <h1>Восстановление пароля</h1>

        <?php if (isset($error)): ?>
          <div><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!isset($_SESSION['recovery_code'])): ?>
          <!-- Step 1: Password Recovery Form -->
          <form action="" method="post">
            <label class="pas_rec_email" for="email">Укажите почту, привязанную к аккаунту:</label>
            <input class="main_input_style inlite_input" style="font-size:18px" type="email" id="email" name="email"
              required>
            <button class="main_button_style" style="font-size:18px" type="submit">Отправить</button>
          </form>
        <?php elseif (empty($_SESSION['code_verified']) || $_SESSION['code_verified'] != true): ?>
          <!-- Step 2: Code Confirmation Form -->
          <form action="" method="post">
            <label for="confirm_code" class="pas_rec_email">Введите код восстановления, отправленный на почту:</label>
            <input style="font-size:18px" class="main_input_style inlite_input" type="text" id="confirm_code"
              name="confirm_code" required>
            <button class="main_button_style " style="font-size:18px" type="submit">Подтвердить</button>
          </form>

        <?php else: ?>
          <!-- Step 3: Password Update Form -->
          <form action="" method="post" class="form_recovery">
            <label class="pas_rec_email" for="password">Введите новый пароль:</label>
            <div class="password-input-container">
              <input class="main_input_style" type="password" id="regpassword" name="password" placeholder="Пароль"
                required>
              <button type="button" id="toggleRegPassword" class="password-toggle"></button>
            </div>
            <span id="pass_span"></span>
            <label class="pas_rec_email" for="confirm_password">Подтвердите новый пароль:</label>
            <div class="password-input-container">
              <input type="password" class="main_input_style" id="regpassword_check" name="password_check"
                placeholder="Подтвердите пароль" required>
              <button type="button" id="toggleRegPasswordCheck" class="password-toggle"></button>
            </div>
            <span id="pass_span_check" style="font-size=18px color=red"></span><br>
            <button class="main_button_style" style="font-size:18px" type="submit">Обновить
              пароль</button>
          </form>
        <?php endif; ?>

        <!-- Форма для отмены восстановления пароля -->
        <form action="password_recovery.php" method="post">
          <button class="main_button_style" style="font-size:18px" type="submit" name="cancel">Отмена</button>
        </form>

      </div>
    </div>
  </div>
</section>
<script src="js/pass_recovery.js"></script>
<?php require_once ('site_modules/no_main_footer.php'); ?>