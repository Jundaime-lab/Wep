<?php
session_start();
if ($_SESSION['level'] != 0) {
    header("Location: login.php");
}

require_once "config/database.php";
require_once "classes/user.php";

$db = new Database();
$conn = $db->connect();
$user = new User($conn);

$id = $_GET['id'];
$user->deleteUser($id);

header("Location: admin_dashboard.php");
