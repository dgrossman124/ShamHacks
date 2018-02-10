var http = require('http');
var SpeechToTextV1 = require('watson-developer-cloud/speech-to-text/v1');
var fs = require('fs');
var speech_to_text = new SpeechToTextV1({
  username: 'f1f8ed13-fe91-4061-a665-b0e7ae68b440',
  password: '1VzZaPldVTHd'
});

var files = ['audio-file.flac'];

for (var file in files) {
  var params = {
    audio: fs.createReadStream(files[file]),
    content_type: 'audio/flac',
    timestamps: true,
    word_alternatives_threshold: 0.9,
    keywords: [],
    keywords_threshold: 0.5
  };
  speech_to_text.recognize(params, function(error, transcript) {
    if (error)
      console.log('Error:', error);
    else
      console.log(JSON.stringify(transcript, null, 2));
  });
}

http.createServer(function(req, res) {
  res.writeHead(200, {
    'Content-Type': 'text/plain'
  });
  res.end(JSON.stringify(json.results[0].alternatives[0].transcript));
}).listen(3456);

console.log('Server running at http://localhost:3456/');

