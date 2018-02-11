<html>

<head>
</head>

<body>

  <div class="container" id="upload">
    <article>
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
        echo '<source src="'.$file.'" type="'.mime_content_type($file).'"><br>'.$text;
        $stmt->close();
      ?>
    </article>
  </div>
  <a href = "main.php">Back to Home</a>
</body>

</html>
