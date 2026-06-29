<?php
session_start();
include 'config/koneksi.php';
include 'templates/header.php';

$message = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_service = trim($_POST['nomor_service'] ?? '');
    $nomor_service = preg_replace('/\D/', '', $nomor_service);

    if ($nomor_service !== '') {
        $query = mysqli_query($koneksi, "SELECT s.*, u.nama AS nama_konsumen FROM service_perbaikan s LEFT JOIN users u ON s.konsumen_id = u.id WHERE s.id = '$nomor_service' LIMIT 1");
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            $message = '<div class="alert alert-success">Data service ditemukan.</div>';
        } else {
            $message = '<div class="alert alert-error">Nomor service tidak ditemukan. Silakan cek kembali nomor nota Anda.</div>';
        }
    } else {
        $message = '<div class="alert alert-error">Silakan masukkan nomor service atau nomor nota.</div>';
    }
}
?>
<div class="page-shell">
    <div class="hero-card">
        <div>
            <h1>Cek Status Service</h1>
            <p>Masukkan nomor service atau nomor nota Anda untuk melihat status perbaikan tanpa perlu login.</p>
        </div>
        <div class="panel">
            <?php echo $message; ?>
            <form method="post">
                <div class="form-group">
                    <label for="nomor_service">Nomor Service / Nomor Nota</label>
                    <input type="text" id="nomor_service" name="nomor_service" placeholder="Contoh: 12 atau #0012" required>
                </div>
                <button type="submit" class="btn">Cek Sekarang</button>
            </form>
        </div>
    </div>

    <?php if ($result): ?>
        <div class="panel" style="margin-top: 20px;">
            <h2>Hasil Pencarian</h2>
            <div class="grid-2">
                <div class="stat-box">
                    <h3>Nomor Service</h3>
                    <p style="font-size: 1.3rem; font-weight: 700; margin: 8px 0 0;">#00<?php echo htmlspecialchars($result['id']); ?></p>
                </div>
                <div class="stat-box">
                    <h3>Status</h3>
                    <p style="font-size: 1.3rem; font-weight: 700; margin: 8px 0 0;"><?php echo htmlspecialchars($result['status_service']); ?></p>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>Nama Pelanggan</th>
                    <td><?php echo htmlspecialchars($result['nama_konsumen'] ?? '-'); ?></td>
                </tr>
                <tr>
                    <th>Perangkat</th>
                    <td><?php echo htmlspecialchars($result['nama_perangkat']); ?></td>
                </tr>
                <tr>
                    <th>Keluhan</th>
                    <td><?php echo htmlspecialchars($result['keluhan']); ?></td>
                </tr>
                <tr>
                    <th>Biaya Jasa</th>
                    <td>Rp <?php echo number_format($result['biaya_jasa'], 0, ',', '.'); ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php include 'templates/footer.php'; ?>
