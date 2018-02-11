<?php
require 'database.php';

$file = $_GET['file'];
$title = $_GET['title'];
date_default_timezone_set('America/Chicago');
$now = date("Y-m-d H:i:s");

mysqli_query($mysqli, "INSERT INTO audio (filename, title, text, datetime) VALUES ('k', 'q', 'e', '{$now}')");
if ($error = mysqli_error($mysqli)) {
  echo $error;
}
else {
  echo "Success!";
}

