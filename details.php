<html>

<head>
</head>

<body>

  <div class="container" id="upload">
    <audio controls>
      <?php
        include('database.php');

        $title = $_GET['title'];
        $tableName = $_GET['table'];
        echo '<header>'.$title.'</header>';
        if ($tableName === "audio") {
          $stmt = $mysqli->prepare("SELECT text, filename FROM audio WHERE title=?");
        }
        else {
          $stmt = $mysqli->prepare("SELECT text FROM video WHERE title=?");
        }
        if(!$stmt){
          printf("Query Prep Failed: %s\n", $mysqli->error);
          exit;
        }
        $stmt->bind_param('s', $title);
        $stmt->execute();
        $stmt->bind_result($text, $file);

        $stmt->fetch();
        $path = pathinfo($audioFile['name'], PATHINFO_EXTENSION);
        if ($path === 'flac') {
          $new_file = str_replace('flac', 'mp3', $file);
          $command = "/usr/local/bin/sox {$file} {$new_file}";
          $file = $new_file;
        }
        echo '<source src="' . $file . '" type="' . mime_content_type($file) . '"><br>' . $text;
        $stmt->close();
      ?>
    </audio>
  </div>
  <a href = "main.php">Back to Home</a>
</body>

</html>

