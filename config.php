<?php

$DB_HOST = "localhost";
$DB_USER = "appuser";       
$DB_PASS = "YourStrongPassword123";
$DB_NAME = "COMPUTING";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die(json_encode([
        "status"  => "error",
        "message" => "Database connection failed: " . $conn->connect_error
    ]));
}

$conn->set_charset("utf8mb4");
?>