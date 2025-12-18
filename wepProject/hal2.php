<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != 1) {
    header("Location: login.php");
}
echo "Selamat datang User";
