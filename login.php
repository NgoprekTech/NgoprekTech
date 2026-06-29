<?php
// Memulai session untuk menyimpan data login user
session_start();

// Memanggil file koneksi yang ada di dalam folder config
include 'config/koneksi.php';

// Variabel untuk menyimpan pesan error jika login gagal
$error = "";

// Memeriksa apakah tombol login sudah diklik
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Melakukan query ke database untuk mencari email dan password yang cocok
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $data  = mysqli_query($koneksi, $query);
    
    // Memeriksa apakah akun ditemukan
    if (mysqli_num_rows($data) > 0) {
        $user = mysqli_fetch_assoc($data);

        // Menyimpan data user ke dalam session
        $_SESSION['id_user']  = $user['id'];
        $_SESSION['nama_user'] = $user['nama'];
        $_SESSION['role']      = $user['role'];

        // Mengarahkan user sesuai dengan role masing-masing
        if ($user['role'] == 'direktur') {
            header("Location: direktur/index.php");
        } elseif ($user['role'] == 'teknisi') {
            header("Location: teknisi/index.php");
        } else {
            header("Location: konsumen/index.php");
        }
        exit;
    } else {
        $error = "Email atau Password yang Anda masukkan salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sistem - Masagi Computer</title>
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8fafc; /* Abu-abu terang khas web modern */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            border: 1px solid #e2e8f0;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 700;
            color: #2563eb; /* Biru Masagi */
            text-align: center;
            margin-bottom: 8px;
        }

        .brand-logo img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            border-radius: 10px;
        }

        .brand-logo span {
            color: #0f172a;
        }

        .login-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Styling Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
            color: #1e293b;
            background-color: #f8fafc;
            transition: all 0.3s;
        }

        /* Efek fokus input box ala Masagi Digital */
        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        /* Notifikasi Error */
        .error-box {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }

        /* Link Kembali */
        .back-to-home {
            display: block;
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s;
        }

        .back-to-home:hover {
            color: #2563eb;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="brand-logo">
        <img src="assets/logo_masagi_computer.png" alt="Logo Masagi Computer">
        <span>Masagi</span><span>Computer</span>
    </div>
    <div class="login-subtitle">Silakan masuk untuk mengakses layanan kami</div>
    
    <!-- Jika ada error, kotak merah ini otomatis muncul -->
    <?php if($error != ""): ?>
        <div class="error-box">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" id="email" name="email" required placeholder="nama@email.com">
        </div>
        
        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        
        <button type="submit" name="login" class="btn-submit">Masuk Ke Sistem</button>
    </form>

    <a href="index.php" class="back-to-home">← Kembali ke Beranda</a>
</div>

</body>
</html>