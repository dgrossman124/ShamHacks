
<?php
require 'database.php';

function getData($isAudio, $mysqli) {
  //$isAudio = true;
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
       $_POST['title'] = $title;
       if ($isAudio) {
         $_POST['table'] = "audio";
       }
       else {
         $_POST['table'] = "video";
       }
       if ($participants === "null") {
         $participants = "";
       }
       printf("<tr><td> %s </td><td> %s</td><td> %s</td><td>%s></td> <td> <a class = \"detailLink\" href=\"details.php?title=" .$title. "&table=".$tableName."\">Details</a>
</tr>\n",
       htmlspecialchars($title),
       htmlspecialchars($tags),
       htmlspecialchars($participants),
       htmlspecialchars($datetime)
      );
    }

    $stmt->close();
  }
  ?>
