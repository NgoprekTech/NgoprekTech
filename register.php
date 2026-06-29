<?php
session_start();
include 'config/koneksi.php';

$message = '';
if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $role = 'konsumen';

    $cek = mysqli_query($koneksi, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek) > 0) {
        $message = '<div class="alert alert-error">Email sudah terdaftar.</div>';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')");
        if ($query) {
            $message = '<div class="alert alert-success">Pendaftaran berhasil. Silakan masuk.</div>';
        } else {
            $message = '<div class="alert alert-error">Pendaftaran gagal.</div>';
        }
    }
}

include 'templates/header.php';
?>
<div class="page-shell">
    <div class="hero-card">
        <div>
            <h1>Daftar Akun Konsumen</h1>
            <p>Buat akun untuk memantau service, riwayat perbaikan, dan pembelian produk.</p>
        </div>
        <div class="panel">
            <?php echo $message; ?>
            <form method="post">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="register" class="btn">Daftar</button>
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>