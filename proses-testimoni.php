<?php
// Pastikan folder uploads/ dan testimoni.json bisa ditulis
$uploadDir = __DIR__ . '/uploads/';
$dataFile = __DIR__ . '/testimoni.json';

// Buat folder uploads jika belum ada
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$nama = htmlspecialchars($_POST['nama']);
$rating = intval($_POST['rating']);
$pesan = htmlspecialchars($_POST['pesan']);
$fotoPath = null;

// Upload foto jika ada
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('testi_', true) . '.' . strtolower($ext);
    $dest = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $dest)) {
        $fotoPath = 'uploads/' . $fileName;
    }
}

// Ambil data lama
$testimoni = [];
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $testimoni = json_decode($json, true) ?? [];
}

// Tambahkan data baru
$testimoni[] = [
    'nama' => $nama,
    'rating' => $rating,
    'pesan' => $pesan,
    'foto' => $fotoPath,
    'tanggal' => date('Y-m-d H:i:s'),
];

// Simpan ulang ke file
file_put_contents($dataFile, json_encode($testimoni, JSON_PRETTY_PRINT));

header('Location: sukses.html');
exit;
?>
