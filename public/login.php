<?php
require_once '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$email = $_POST['email'];
$password = $_POST['password'];
$stmt = $conn->prepare("SELECT id, password FROM users WHERE email =
?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
$stmt->bind_result($id, $hashed_password);
$stmt->fetch();
if (password_verify($password, $hashed_password)) {
session_start();
$_SESSION['user_id'] = $id;
echo "Login successful!";
} else {
echo "Invalid password!";
}
} else {
echo "No user found with that email address!";
}
$stmt->close();
$conn->close();
}