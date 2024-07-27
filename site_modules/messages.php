<?php 
// if (isset($_SESSION['message_success'])) {
//   echo '<script>';
//   echo 'alert("' . $_SESSION['message_success'] . '");';
//   echo '</script>';
//   unset($_SESSION['message_success']);
// }

// if (isset($_SESSION['message_error'])) {
//   echo '<script>';
//   echo 'alert("' . $_SESSION['message_error'] . '");';
//   echo '</script>';
//   unset($_SESSION['message_error']);
// }

// if (isset($_SESSION['message'])) {
//   echo '<script>';
//   echo 'alert("' . $_SESSION['message'] . '");';
//   echo '</script>';
//   unset($_SESSION['message']);
// }

// if (isset($_SESSION['working'])) {
//   echo '<script>';
//   echo 'alert("' . $_SESSION['working'] . '");';
//   echo '</script>';
//   unset($_SESSION['working']);
// }


function displayModalMessage($message) {
    echo "<script>showModal('$message');</script>";
}

session_start();

if (isset($_SESSION['message_success'])) {
    displayModalMessage($_SESSION['message_success']);
    unset($_SESSION['message_success']);
}

if (isset($_SESSION['message_error'])) {
    displayModalMessage($_SESSION['message_error']);
    unset($_SESSION['message_error']);
}

if (isset($_SESSION['message'])) {
    displayModalMessage($_SESSION['message']);
    unset($_SESSION['message']);
}

if (isset($_SESSION['working'])) {
    displayModalMessage($_SESSION['working']);
    unset($_SESSION['working']);
}


?>
