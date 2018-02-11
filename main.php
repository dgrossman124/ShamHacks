<!DOCTYPE html>
<html>

<head>
  <!-- <script data-main="../main" src="../require.js"></script> -->
</head>

<body>
<link rel="stylesheet" type="text/css" href="design.css">
  <div class="container">
    <header>
      <h1>Veteran Interview Database</h1>
      <div id = submit>
        <a href='submit.html'>Submit files here</a
      </div>
      <form action="search.php" method="GET">
        <input type="text" name="query" />
        <input type="submit" value="Search" />
      </form>
    </header>
    <table id="table">
      <tr>
        <th>Title</th>
        <th>Tags</th>
        <th>Participants</th>
        <th>Date Uploaded</th>
      </tr>
      <?php
      include('database.php');
      include('populateTable.php');
      getData(true, $mysqli);
      getData(false, $mysqli);
      ?>
    </table>
  </div>
</body>

</html>
