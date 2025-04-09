<?php
// Konfigurasi
$uploadDir = __DIR__ . '/uploads/';
$dataFile = __DIR__ . '/testimoni.json';

// Pastikan folder upload ada
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Ambil input dengan validasi dasar
$nama   = htmlspecialchars(trim($_POST['nama'] ?? ''));
$rating = intval($_POST['rating'] ?? 0);
$pesan  = htmlspecialchars(trim($_POST['pesan'] ?? ''));
$fotoPath = null;

// Validasi wajib
if (empty($nama) || empty($rating) || empty($pesan)) {
    die("Semua field wajib diisi!");
}

// Proses upload foto jika ada
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $mime = mime_content_type($_FILES['foto']['tmp_name']);

    if (in_array($mime, $allowedTypes)) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('testi_', true) . '.' . strtolower($ext);
        $dest = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $dest)) {
            $fotoPath = 'uploads/' . $fileName;
        }
    }
}

// Ambil data testimoni lama
$testimoni = [];
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $testimoni = json_decode($json, true) ?? [];
}

// Tambahkan testimoni baru
$testimoni[] = [
    'nama' => $nama,
    'rating' => $rating,
    'pesan' => $pesan,
    'foto' => $fotoPath,
    'tanggal' => date('Y-m-d H:i:s'),
];

// Simpan ke file JSON
file_put_contents($dataFile, json_encode($testimoni, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Redirect ke halaman sukses
header('Location: sukses.html');
exit;
