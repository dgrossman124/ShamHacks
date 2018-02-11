<?php

require(database.php);

function getData($isAudio) {
  $tableName = "";
  if ($isAudio) {
    $tableName = "audio";
  }
  else {
    $tableName = "video";
  }
  $stmt = $mysqli->prepare("SELECT title, tags, participants, datetime from " .$tableNAme ." order by datetime");
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
  }
?>
