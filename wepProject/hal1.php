<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != 0) {
    header("Location: login.php");
}
?>

<h2>Halaman Utama</h2>
<p>Selamat datang, <?= $_SESSION['username']; ?></p>

<?php if ($_SESSION['level'] === 0): ?>
    <li><a href="admin_dashboard.php">Admin Panel</a></li>
<?php endif; ?>

<a href="logout.php">Logout</a>