<?php
session_start();

require_once "config/database.php";
require_once "classes/user.php";

$db = new Database();
$conn = $db->connect();

$user = new User($conn);

$username = $_POST['username'];
$password = $_POST['password'];

$result = $user->login($username, $password);

if ($result) {
    $_SESSION['username'] = $result['username'];
    $_SESSION['level'] = $result['level'];


    if ($result['level'] == 0) {
        header("Location: hal1.php"); // Admin
    } else {
        header("Location: hal2.php"); // User
    }
} else {
    echo "Login gagal";
}
