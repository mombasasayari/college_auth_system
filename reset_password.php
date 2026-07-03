<?php
header('Content-Type: application/json');
require_once 'config.php';

$email       = trim($_POST['email'] ?? '');
$newPassword = $_POST['new_password'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Please provide a valid email address."]);
    exit;
}

if (strlen($newPassword) < 6) {
    echo json_encode(["status" => "error", "message" => "New password must be at least 6 characters long."]);
    exit;
}

$stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "No account found with that email address."]);
    $stmt->close();
    exit;
}
$stmt->close();

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hashedPassword, $email);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Your password has been reset successfully. You can now log in."]);
} else {
    echo json_encode(["status" => "error", "message" => "Password reset failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>