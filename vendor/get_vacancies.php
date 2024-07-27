<?php
require_once ('connection.php');

$sql = "SELECT id, company, title FROM vacancies";
$result = $conn->query($sql);

$vacancies = array();
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $vacancies[] = $row;
  }
}

header('Content-Type: application/json');
echo json_encode($vacancies);
