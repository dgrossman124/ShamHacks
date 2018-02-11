<!DOCTYPE html>
<html>

<head>
  <!-- <script data-main="../main" src="../require.js"></script> -->
</head>

<body>
 <link rel="stylesheet" type="text/css" href="design.css">
  <div class="container">
    <header>
      <h1>Files</h1>
      <a href='submit.html'>Submit files here</a>
    </header>
    <table id="table">
      <tr>
        <th>Date Uploaded</th>
        <th>Tags</th>
        <th>Participants</th>
      </tr>
      <?php

      include('database.php');

      //function getData($isAudio) {
        $isAudio = true;
        $tableName = "";
        if ($isAudio) {
          $tableName = "audio";
        }
        else {
          $tableName = "video";
        }
        $stmt = $mysqli->prepare("SELECT title, tags, participants, datetime from " .$tableName ." order by datetime");
        if(!$stmt){
      	   printf("Query Prep Failed: %s\n", $mysqli->error);
      	    exit;
          }

          $stmt->execute();

          $stmt->bind_result($title, $tags, $participants, $datetime);

          while($stmt->fetch()){
      	     printf("<tr><td> %s </td><td> %s</td><td> %s</td><td>%s></td></tr>\n",
      		   htmlspecialchars($title),
      		   htmlspecialchars($tags),
             htmlspecialchars($participants),
             htmlspecialchars($datetime)
      	    );
          }

          $stmt->close();
        //}
      ?>
  </div>
  <script src="../main.js"></script>
</body>

</html>
