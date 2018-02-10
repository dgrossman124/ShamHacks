var SpeechToTextV1 = require('watson-developer-cloud/speech-to-text/v1');
var fs = require('fs');
var speech_to_text = new SpeechToTextV1({
  username: 'f1f8ed13-fe91-4061-a665-b0e7ae68b440',
  password: '1VzZaPldVTHd'
});

// Takes in a string that represents the name of an audio file and returns
// its transcription
function addFiles(var file) {
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
      return error;
    else
      return json.results[0].alternatives[0].transcript;
  });
}

