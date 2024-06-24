<?php
require_once '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (name, email, password)
VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);
if ($stmt->execute()) {
echo "Registration successful!";
} else {
echo "Error: " . $stmt->error;
}
