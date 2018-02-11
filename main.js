var operations = require("operations");

function display(tableName) {
  connection = connect();
  connection.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    var insertQuery = "SELECT title, tags, participants, datetime FROM " + tableName;
    connection.query(insertQuery, function (err, result) {
      if (err) throw err;
      var inner = "<tr><th>Title</th><th>Tags</th><th>Participants</th><th>Date Uploaded</th></tr>";
      for(var i = 0; i < result.length; i++){
        inner += "<tr><td>" + result[i].title + "</td><td>" + result[i].tags + "</td><td>" + result[i].participants + "</td><td>" + result[i].datetime + "</td></tr>";
      }
      document.getElementById("table").innerHTML = inner;
      console.log("Table displayed");
    });
  });
}

document.onload = display("audio");
