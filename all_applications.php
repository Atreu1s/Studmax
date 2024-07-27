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
require_once('vendor/connection.php');
?>

<div class="pesonal_back"></div>
<?php
require_once ('site_modules/navbar.php');
?>
<section class="all_applications">
  <div class="body_area">
    <div class="applications_area">
      <h1>Все заявления на добавления вакансии</h1>
      
      <div class='applicatoin_grid'>
        <?php 
        $sql = 'SELECT * FROM job_application';
        $result = $conn->query($sql);
        if($result->num_rows>0){
          while($row = $result->fetch_assoc()){
            echo '<div class="app_cart">';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '<p>' . $row['company'] . '</p>';
            echo '<p>' . $row['status'] . '</p>';
            echo '<a href="application.php?id=' . $row['id'] . '">Посмотреть</a>';

            echo "</div>";
          }
        } else {
          echo "Нет заявлений на добавление вакансии";
        }
        ?>
      </div>
    </div>
  </div>
</section>
<script src="js/menu.js"></script>
<?php require_once ('site_modules/no_main_footer.php') ?>