<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != 0) {
    header("Location: login.php");
}

require_once "config/database.php";
require_once "classes/user.php";

$db = new Database();
$conn = $db->connect();
$user = new User($conn);

if (isset($_POST['simpan'])) {
    $user->createUser($_POST['username'], $_POST['password'], $_POST['level']);
    header("Location: admin_dashboard.php");
}
?>

<h3>Tambah User</h3>
<form method="post">
    Username:<br>
    <input type="text" name="username" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    Level:<br>
    <select name="level">
        <option value="0">Admin</option>
        <option value="1">User</option>
    </select><br><br>
    <button name="simpan">Simpan</button>
</form>