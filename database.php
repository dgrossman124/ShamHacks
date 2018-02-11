<?php

$mysqli = new mysqli('localhost', 'Nick', 'DatabasePass', 'ShamHacks');

if($mysqli->connect_errno) {
    echo "Connection failed";
    exit;
}
