<?php
session_start();
// Menghapus semua session login
session_destroy();
// Melempar kembali ke halaman beranda
header("Location: index.php");
exit;