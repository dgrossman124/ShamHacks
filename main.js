var operations = require("operations");

function display(tableName) {
  connection = connect();
  connection.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    var insertQuery = "SELECT * FROM " + tableName;
    connection.query(insertQuery, function (err, result) {
      if (err) throw err;
      console.log("Table displayed");
    });
  });
}

document.onload = display("audio");
