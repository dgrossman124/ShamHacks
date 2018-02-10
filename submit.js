var operations = require("operations");
function submit(){
  var radios = document.getElementsByName("fileType");
  var isAudio = radios[0].checked;
  var file = document.getElementById("myFile").name;
  var title = document.getElementById("title").value;
  operations.insertIntoDatabase(isAudio, file, title, title, title);
}
