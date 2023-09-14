<?php

$conn = new mysqli('localhost', 'root', '', 'datab');
if ($conn->connect_errno) {
    die('connection failed:' . $conn->connect_error);
} 

?>