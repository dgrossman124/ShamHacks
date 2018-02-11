<?php
require 'database.php';
require 'watson.php';

// Pull in form vars
$title = $_POST['title'];
$audioFile = $_FILES['audioFile'];
$name = "./{$audioFile['name']}";

// Add file to our file system
move_uploaded_file($audioFile['tmp_name'], $name);
date_default_timezone_set('America/Chicago');
$now = date("Y-m-d H:i:s");
$transcript = transcriptAudioFile($name);

mysqli_query($mysqli, "INSERT INTO audio (filename, title, text, datetime) VALUES ('{{$audioFile['name']}}', '$title', '$transcript', '{$now}')");
exec("rm {$name}");

if ($error = mysqli_error($mysqli)) {
  echo $error;
}
else {
  echo $transcript;
}

