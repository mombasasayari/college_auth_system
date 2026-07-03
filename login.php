<?php
session_start();
header('Content-Type: application/json');
require_once 'config.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    echo json_encode(["status" => "error", "message" => "Username and password are required."]);
    exit;
}

$stmt = $conn->prepare("SELECT user_id, full_name, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
    $stmt->close();
    exit;
}

$user = $result->fetch_assoc();

if (password_verify($password, $user['password'])) {
    $_SESSION['user_id']   = $user['user_id'];
    $_SESSION['full_name'] = $user['full_name'];

    echo json_encode([
        "status"    => "success",
        "message"   => "Login successful.",
        "full_name" => $user['full_name']
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
}

$stmt->close();
$conn->close();
?>