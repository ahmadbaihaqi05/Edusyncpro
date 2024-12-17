<?php
require 'server.php';

// data statis jadwal yang sudah ada
$existingSchedules = [
    ['hari' => 'Senin', 'jam' => 1, 'guru' => 'Guru A', 'mataPelajaran' => 'Matematika', 'kelas' => 10],
    ['hari' => 'Senin', 'jam' => 2, 'guru' => 'Guru B', 'mataPelajaran' => 'Kimia', 'kelas' => 11],
    ['hari' => 'Selasa', 'jam' => 1, 'guru' => 'Guru A', 'mataPelajaran' => 'Biologi', 'kelas' => 11],
    ['hari' => 'Rabu', 'jam' => 2, 'guru' => 'Guru C', 'mataPelajaran' => 'Kimia', 'kelas' => 10],
    ['hari' => 'Kamis', 'jam' => 2, 'guru' => 'Guru B', 'mataPelajaran' => 'Matematika', 'kelas' => 10],
    ['hari' => 'Kamis', 'jam' => 1, 'guru' => 'Guru C', 'mataPelajaran' => 'Biologi', 'kelas' => 10]
];

// Ambil input dari client
$inputData = file_get_contents('php://input');

// Deteksi format input (JSON atau XML)
$inputType = strpos($inputData, '<request>') !== false ? 'xml' : 'json';

if ($inputType === 'xml') {
    // Parsing XML
    $xml = simplexml_load_string($inputData, "SimpleXMLElement", LIBXML_NOCDATA);
    $request = json_decode(json_encode($xml), true);
} else {
    // Parsing JSON
    $request = json_decode($inputData, true);
}

// Validasi input
if (!isset($request['nama_guru']) || !isset($request['hari_lama']) || 
    !isset($request['jam_lama']) || !isset($request['hari_baru']) || 
    !isset($request['jam_baru']) || !isset($request['sistem_belajar'])) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Input tidak lengkap']);
    exit;
}

// Ambil data dari request
$namaGuru = $request['nama_guru'];
$hariLama = $request['hari_lama'];
$jamLama = $request['jam_lama'];
$hariBaru = $request['hari_baru'];
$jamBaru = $request['jam_baru'];
$sistemBelajar = $request['sistem_belajar'];

// proses pengalokasian apakah alokasi berhasil atau gagal
$isScheduleTaken = false;
foreach ($existingSchedules as $schedule) {
    if ($schedule['hari'] === $hariBaru && $schedule['jam'] == $jamBaru) {
        $isScheduleTaken = true;
        break;
    }
}

if ($isScheduleTaken) {
    $response = [
        'status' => 'failure',
        'message' => "Pada hari $hariBaru jam pelajaran ke-$jamBaru sudah terisi oleh guru lain, sehingga jadwal baru bentrok!"
    ];
} elseif ($hariBaru === 'Minggu') { // kondisi jika hari yang dipilih adalh minggu
    $response = [
        'status' => 'failure',
        'message' => "Alokasi jadwal gagal. Hari $hariBaru tidak tersedia untuk pembelajaran."
    ];
} else {
    $response = [
        'status' => 'success',
        'message' => "Jadwal berhasil diubah pada hari $hariBaru jam pelajaran ke-$jamBaru dengan pembelajaran $sistemBelajar."
    ];
}

// mengembalikan hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
