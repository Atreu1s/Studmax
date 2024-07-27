<?php 

require_once('site_modules/header.php');
require_once('site_modules/navbar.php');

?>
<section class="materials">
  <div class="body_area">
    <div class="materials_body">
      <h1>Полезные материалы</h1>
      <div class="grid_materials_container">

        <div class="mat_container">
          <h2>PHP</h2>
          <div class="container_main_inf">
            <a href="https://metanit.com/">metanit</a>
            <a href="https://stepik.org/catalog">stepik</a>
          </div>
        </div>

        <div class="mat_container">
          <h2>JS</h2>
          <div class="container_main_inf">
            <a href="https://metanit.com/">metanit</a>
            <a href="https://stepik.org/catalog">stepik</a>
          </div>
        </div>

        <!--! Тут крч пхп из базы данных  -->
        <!-- <?php 
          // require_once("vendor/connection.php");
          // $sql = "SELECT * FROM materials";
          // $result = $conn->query($sql);
          // if ($result->num_rows > 0) {
          //   while ($row = $result->fetch_assoc()) {
          //     echo '
          //     <div class="mat_container">
          //       <h2>'.$row['title'].'</h2>
          //       <div class="container_main_inf">
          //         <p>'.$row['description'].'</p>
          //       </div>
          //     </div>
          //     ';
          //   }
          // }
        ?> -->

      </div>
    </div>
  </div>
</section>

<?php
require_once('site_modules/no_main_footer.php');
?>