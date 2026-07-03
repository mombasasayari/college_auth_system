<?php
header('Content-Type: application/json');
require_once 'config.php';

$full_name = trim($_POST['full_name'] ?? '');
$username  = trim($_POST['username'] ?? '');
$email     = trim($_POST['email'] ?? '');
$password  = $_POST['password'] ?? '';

$errors = [];

if (strlen($full_name) < 3) {
    $errors[] = "Full name must be at least 3 characters.";
}

if (!preg_match('/^[a-zA-Z0-9_]{4,50}$/', $username)) {
    $errors[] = "Username must be 4-50 characters (letters, numbers, underscore only).";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please provide a valid email address.";
}

if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters long.";
}

if (!empty($errors)) {
    echo json_encode(["status" => "error", "message" => implode(" ", $errors)]);
    exit;
}

$stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Username or email is already registered."]);
    $stmt->close();
    exit;
}
$stmt->close();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $username, $email, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Account created successfully! You can now log in."]);
} else {
    echo json_encode(["status" => "error", "message" => "Registration failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>