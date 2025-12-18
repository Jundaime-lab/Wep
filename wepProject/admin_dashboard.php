<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != 0) {
    header("Location: login.php");
    exit;
}

require_once "config/database.php";
require_once "classes/user.php";

$db = new Database();
$conn = $db->connect();
$user = new User($conn);
$data = $user->getAllUsers();
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>


<div class="header">
<h2>Admin Dashboard</h2>
</div>


<div class="container">
<div class="card">
<p>Selamat datang, <b><?= $_SESSION['username']; ?></b></p>
<a href="tambah_user.php" class="btn">+ Tambah User</a>
<a href="logout.php" class="btn btn-danger">Logout</a>


<table>
<tr>
<th>ID</th>
<th>Username</th>
<th>Level</th>
<th>Aksi</th>
</tr>
<?php while($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
<tr>
<td><?= $row['id']; ?></td>
<td><?= $row['username']; ?></td>
<td><?= $row['level'] == 0 ? 'Admin' : 'User'; ?></td>
<td>
<a href="hapus_user.php?id=<?= $row['id']; ?>" class="btn btn-danger"
onclick="return confirm('Yakin hapus user?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>
</div>


<div class="footer">
<small>&copy; <?= date('Y'); ?> Sistem Login Multi Level</small>
</div>


</body>
</html>

