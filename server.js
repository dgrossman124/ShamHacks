// Require the functionality we need to use:
var http = require('http'),
  url = require('url'),
  mime = require('mime'),
  path = require('path'),
  fs = require('fs'),
  mysql = require('mysql');

	http.createServer(function(req, res){
	    fs.readFile('submit.html',function (err, data){
	        res.writeHead(200, {'Content-Type': 'text/html','Content-Length':data.length});
	        res.write(data);
	        res.end();
	    });
	}).listen(8000);

// Make a simple fileserver for all of our static content.
// Everything underneath <STATIC DIRECTORY NAME> will be served.
var app = http.createServer(function(req, resp) {
  var filename = path.join(__dirname, "html", url.parse(req.url).pathname);
  (fs.exists || path.exists)(filename, function(exists) {
    if (exists) {
      fs.readFile(filename, function(err, data) {
        if (err) {
          // File exists but is not readable (permissions issue?)
          resp.writeHead(500, {
            "Content-Type": "text/plain"
          });
          resp.write("Internal server error: could not read file");
          resp.end();
          return;
        }

        // File exists and is readable
        var mimetype = mime.getType(filename);
        resp.writeHead(200, {
          "Content-Type": mimetype
        });
        resp.write(data);
        resp.end();
        return;
      });
    } else {
      // File does not exist
      resp.writeHead(404, {
        "Content-Type": "text/plain"
      });
      resp.write("Requested file not found: " + filename);
      resp.end();
      return;
    }
  });
});
app.listen(3456);

function connect() {
  var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "dictionarycheck",
    database: "ShamHacks"
  });
  return con;
}
exports.insertIntoDatabase = function(isAudio, filename, title, text, tags = null, participants = null) {
  connection = connect();
  connection.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");

    var tableName = "";
    if (isAudio) {
      tableName = "audio";
    } else {
      tableName = "video";
    }

    var today = new Date();

    // changes the date from Javascript format to MySQL format
    today = today.toISOString().slice(0, 19).replace('T', ' ');

    var insertQuery = "INSERT INTO " + tableName + " (filename, title, text, tags, datetime, participants) VALUES ( \'" + filename + "\', \'" + title + "\', \'" + text + "\', \'" + tags + "\', \'" + today + "\', \'" + participants + "\')";
    connection.query(insertQuery, function(err, result) {
      if (err) throw err;
      console.log("1 record inserted");
    });
  });
}

function display(tableName) {
  connection = connect();
  connection.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    var insertQuery = "SELECT title, tags, participants, datetime FROM " + tableName;
    connection.query(insertQuery, function(err, result) {
      if (err) throw err;
      var inner = "<tr><th>Title</th><th>Tags</th><th>Participants</th><th>Date Uploaded</th></tr>";
      for (var i = 0; i < result.length; i++) {
        inner += "<tr><td>" + result[i].title + "</td><td>" + result[i].tags + "</td><td>" + result[i].participants + "</td><td>" + result[i].datetime + "</td></tr>";
      }
      document.getElementById("table").innerHTML = inner;
      console.log("Table displayed");
    });
  });
}

function submit(){
  var radios = document.getElementsByName("fileType");
  var isAudio = radios[0].checked;
  var file = document.getElementById("myFile").name;
  var title = document.getElementById("title").value;
  operations.insertIntoDatabase(isAudio, file, title, title, title);
}

// document.onload = display("audio");
