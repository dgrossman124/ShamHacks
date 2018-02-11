<?php

function transcriptAudioFile($file_location) {
  $fh = fopen($file_location, "r");
  $ch = curl_init();
  $opts = [
    CURLOPT_URL => "https://stream.watsonplatform.net/speech-to-text/api/v1/recognize",
    CURLOPT_HTTPHEADER => [
      "X-Watson-Learning-Opt-Out: true",
      "Content-Type: audio/x-flac",
      "Transfer-Encoding: chunked"
    ],
    CURLOPT_USERPWD => 'f1f8ed13-fe91-4061-a665-b0e7ae68b440:1VzZaPldVTHd',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_INFILE => $fh,
    CURLOPT_BINARYTRANSFER => true
  ];
  curl_setopt_array($ch, $opts);
  $response = curl_exec($ch);
  if ($response !== false) {
    $response = json_decode($response, true);
    if (isset($response['results'][0]['alternatives'][0]['transcript'])) {
      return $response['results'][0]['alternatives'][0]['transcript'];
    }
  }
  else {
    return false;
  }
}

