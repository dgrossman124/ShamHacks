function submit(){
  var radios = document.getElementsByName("fileType");
  var isAudio = radios[0].checked;
  if (document.getElementById("myFsubsuile") !== null) {
    var file = document.getElementById("myFsubsuile").files[0].name;
  }
  else {
    var file = "null";
  }
  if (document.getElementById("title") !== null) {
    var title = document.getElementById("title").value;
  }
  else {
    var title = "null";
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "/ShamHacks/add_file.php?", true);
  var dataString = "file=" + encodeURIComponent(file) + "&title=" + encodeURIComponent(title);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send(dataString);
  xmlhttp.addEventListener("load", function () {
    if (this.readyState == 4 && this.status == 200) {
      if (document.getElementById('paragraph') !== null) {
        document.getElementById('paragraph').innerHTML = this.responseText;
      }
      else {
        alert("hello");
      }
    }
    else {
      document.getElementById('paragraph').innerHTML = this.status;
    }
  });
}

