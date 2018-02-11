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
          $stmt = $mysqli->prepare("SELECT text FROM audio WHERE title=?");
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
        $stmt->bind_result($text);
        echo 'Actual String'.$text;
        $stmt->close();
      ?>
    </article>
  </div>
</body>

</html>
