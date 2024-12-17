<?php

class Guru {
    // Data statis jadwal guru dengan informasi kelas yang sedang diajar
    private $jadwalKelas = [
        ['guru' => 'Guru A', 'hari' => 'Senin', 'jamPelajaran' => 1, 'mataPelajaran' => 'Matematika', 'kelas' => 10],
        ['guru' => 'Guru B', 'hari' => 'Senin', 'jamPelajaran' => 2, 'mataPelajaran' => 'Kimia', 'kelas' => 11],
        ['guru' => 'Guru A', 'hari' => 'Selasa', 'jamPelajaran' => 2, 'mataPelajaran' => 'Fisika', 'kelas' => 11],
        ['guru' => 'Guru C', 'hari' => 'Kamis', 'jamPelajaran' => 1, 'mataPelajaran' => 'Biologi', 'kelas' => 10],
    ];

    // Fungsi untuk mengganti guru pada jadwal tertentu
    public function GantiGuru($params) {
        $namaGuruLama = $params->namaGuruLama;
        $namaGuruBaru = $params->namaGuruBaru;
        $hari = $params->hari;
        $jamPelajaran = $params->jamPelajaran;

        // Logika sederhana untuk validasi
        if ($namaGuruLama === "Guru A" && $hari === "Senin" && $jamPelajaran === 1) {
            return [
                "status" => "sukses",
                "message" => "$namaGuruLama di hari $hari jam pelajaran $jamPelajaran telah diganti dengan $namaGuruBaru."
            ];
        } else {
            return [
                "status" => "gagal",
                "message" => "Tidak ditemukan jadwal dengan $namaGuruLama di hari $hari jam pelajaran $jamPelajaran."
            ];
        }
    }
       
}

