<?php
include 'database.php';
function searchForREsult($query, $mysqli){

  //$query = $_GET['query'];
      // gets value sent over search form

  $min_length = 3;
      // you can set minimum length of the query if you want

  if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
    $query = htmlspecialchars($query);
    // changes characters used in html to their equivalents, for example: < to &gt;
    $query = mysql_real_escape_string($query);

    $stmt = $mysqli->prepare("SELECT title, tags, participants, datetime FROM audio WHERE (`title` LIKE '%".$query."%') OR (`tags` LIKE '%".$query."%') OR (`participants` LIKE '$".$query."%') OR (`text` LIKE '%".$query."%')");
    if(!$stmt) {
      printf("Query Prep Failed: %s\n", $mysqli->error);
      exit;
    }
    $stmt->execute();

    $stmt->bind_result($title, $tags, $participants, $datetime);
    while($stmt->fetch()){
      printf("<tr><td> %s </td><td> %s</td><td> %s</td><td>%s></td> <td> <a class = \"detailLink\" href=\"details.php?title=" .$title. "&table=audio\">Details</a>
</tr>\n",
      htmlspecialchars($title),
      htmlspecialchars($tags),
      htmlspecialchars($participants),
      htmlspecialchars($datetime)
     );
    }
    $stmt->close();


    $stmt = $mysqli->prepare("SELECT title, tags, participants, datetime FROM video WHERE (`title` LIKE '%".$query."%') OR (`tags` LIKE '%".$query."%') OR (`participants` LIKE '$".$query."%') OR (`text` LIKE '%".$query."%')");
    if(!$stmt) {
      printf("Query Prep Failed: %s\n", $mysqli->error);
      exit;
    }
    $stmt->execute();

    $stmt->bind_result($title, $tags, $participants, $datetime);
    while($stmt->fetch()){
      printf("<tr><td> %s </td><td> %s</td><td> %s</td><td>%s></td> <td> <a class = \"detailLink\" href=\"details.php?title=" .$title. "&table=video\">Details</a>
</tr>\n",
      htmlspecialchars($title),
      htmlspecialchars($tags),
      htmlspecialchars($participants),
      htmlspecialchars($datetime)
     );
    }
    $stmt->close();
  }

  else{ // if query length is less than minimum
    echo "Minimum length is ".$min_length;
  }
}
?>
