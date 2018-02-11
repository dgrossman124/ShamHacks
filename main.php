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
  </div>
  <script src="../main.js"></script>
</body>

</html>
