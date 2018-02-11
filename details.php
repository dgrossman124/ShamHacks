<html>

<head>
</head>

<body>

  <div class="container" id="upload">
    <article>
      <?php
        include('database.php');

        $title = $_GET['title'];
        $tableName = $_POST['table'];
        echo '<header>'.title.'</header>';
        $stmt = $mysqli->prepare("SELECT text FROM ".$tableName." WHERE title=".$title);
        if(!$stmt){
          printf("Query Prep Failed: %s\n", $mysqli->error);
          exit;
        }
        $stmt->execute();
        $stmt->bind_result($text);
        echo $text;
      ?>
    </article>
  </div>
</body>

</html>
