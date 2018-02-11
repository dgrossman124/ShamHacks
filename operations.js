require(['mysql'], function ($) {
  function connect() {
  var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "dictionarycheck",
    database: "ShamHacks"
  });
  return con;
}});

// isAudio represents which table this is going INTO
// default arguments for tags and participants are null
// Usage:
// var operations = require("./operations");
// operations.insertIntoDatabase(true, "www.google.com", "google", "This is google", "goog");
exports.insertIntoDatabase = function (isAudio, filename, title, text, tags = null, participants = null) {
  connection = connect();
  connection.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");

    var tableName = "";
    if (isAudio){
      tableName = "audio";
    }
    else {
      tableName = "video";
    }

    var today = new Date();

    // changes the date from Javascript format to MySQL format
    today = today.toISOString().slice(0, 19).replace('T', ' ');

    var insertQuery = "INSERT INTO " + tableName + " (filename, title, text, tags, datetime, participants) VALUES ( \'" + filename + "\', \'" + title + "\', \'" + text + "\', \'" + tags + "\', \'" + today + "\', \'" + participants + "\')";
    connection.query(insertQuery, function (err, result) {
      if (err) throw err;
      console.log("1 record inserted");
    });
  });
}
