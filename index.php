<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masagi Computer | Solusi Penjualan & Perbaikan Komputer</title>
    <!-- Menggunakan Google Fonts agar tipografi mirip web modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Navbar - Khas Masagi yang Clean */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: 700;
            color: #2563eb; /* Warna Biru Utama Masagi */
        }

        .logo img {
            width: 44px;
            height: 44px;
            object-fit: contain;
            border-radius: 10px;
        }

        .logo span {
            color: #0f172a;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: #475569;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #2563eb;
        }

        .btn-login {
            background-color: #2563eb;
            color: #ffffff;
            padding: 10px 22px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: #1d4ed8;
        }

        /* Hero Section - Bagian Utama */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 8%;
            min-height: 80vh;
        }

        .hero-text {
            max-width: 50%;
        }

        .hero-text h1 {
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            color: #0f172a;
            margin-bottom: 20px;
        }

        .hero-text h1 span {
            color: #2563eb;
        }

        .hero-text p {
            font-size: 18px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        .cta-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 14px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #2563eb;
            padding: 14px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid #e2e8f0;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        /* Layanan Section */
        .services {
            padding: 80px 8%;
            background-color: #ffffff;
            text-align: center;
        }

        .services h2 {
            font-size: 32px;
            color: #0f172a;
            margin-bottom: 40px;
        }

        .service-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .service-box {
            background: #f8fafc;
            padding: 40px 30px;
            border-radius: 8px;
            width: 350px;
            text-align: left;
            border: 1px solid #f1f5f9;
            transition: transform 0.3s;
        }

        .service-box:hover {
            transform: translateY(-5px);
        }

        .service-box h3 {
            font-size: 20px;
            color: #0f172a;
            margin-bottom: 15px;
        }

        .service-box p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.5;
        }
    </style>
</head>
<body>

    <!-- NAVIGASI -->
    <nav>
        <div class="logo">
            <img src="assets/logo_masagi_computer.png" alt="Logo Masagi Computer">
            <span>Masagi</span><span style="color:#0f172a;">Computer</span>
        </div>
        <ul>
            <li><a href="#home">Beranda</a></li>
            <li><a href="#layanan">Layanan</a></li>
            <li><a href="login.php">Cek Service</a></li>
        </ul>
        <?php if(isset($_SESSION['role'])): ?>
            <a href="<?php echo $_SESSION['role']; ?>/index.php" class="btn-login">Dashboard</a>
        <?php else: ?>
            <a href="login.php" class="btn-login">Masuk Sistem</a>
        <?php endif; ?>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="hero-text">
            <h1>Solusi Terpercaya untuk <span>Perangkat Digital</span> Anda.</h1>
            <p>Masagi Computer melayani penjualan perangkat keras berkualitas tinggi serta layanan perbaikan (service) laptop, komputer, dan gadget secara profesional, transparan, dan bergaransi.</p>
            <div class="cta-buttons">
                <a href="login.php" class="btn-primary">Ajukan Service</a>
                <a href="cek_service.php" class="btn-secondary">Cek Status Service</a>
            </div>
        </div>
        <div class="hero-image">
            <!-- Tempat menaruh gambar dummy representasi IT/Komputer modern -->
            <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=500&auto=format&fit=crop&q=60" alt="Masagi Computer Workspace">
        </div>
    </section>

    <!-- LAYANAN SECTION -->
    <section class="services" id="layanan">
        <h2>Layanan Utama Kami</h2>
        <div class="service-container">
            <div class="service-box">
                <h3>💻 Penjualan Perangkat</h3>
                <p>Menyediakan komputer, laptop, aksesoris, dan sparepart orisinal dengan jaminan garansi resmi dan harga terbaik.</p>
            </div>
            <div class="service-box">
                <h3>🛠️ Perbaikan Profesional</h3>
                <p>Penanganan kerusakan hardware maupun software oleh teknisi berpengalaman. Proses transparan dan status bisa dipantau online.</p>
            </div>
        </div>
    </section>

</body>
</html>