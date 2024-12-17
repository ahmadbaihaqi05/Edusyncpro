<?php

class Guru {
    // Data statis jadwal guru dengan informasi kelas yang sedang diajar
    private $jadwalKelas = [
        ['guru' => 'Guru A', 'hari' => 'Senin', 'jamPelajaran' => 1, 'mataPelajaran' => 'Matematika', 'kelas' => 10],
        ['guru' => 'Guru B', 'hari' => 'Senin', 'jamPelajaran' => 2, 'mataPelajaran' => 'Kimia', 'kelas' => 11],
        ['guru' => 'Guru A', 'hari' => 'Selasa', 'jamPelajaran' => 2, 'mataPelajaran' => 'Fisika', 'kelas' => 11],
        ['guru' => 'Guru C', 'hari' => 'Kamis', 'jamPelajaran' => 1, 'mataPelajaran' => 'Biologi', 'kelas' => 10],
    ];
    
    // Fungsi untuk mengecek ketersediaan guru
    public function cekKetersediaanGuru($nama, $hari, $jamPelajaran) {
        // Periksa jadwal guru
        foreach ($this->jadwalKelas as $jadwal) {
            if ($jadwal['guru'] == $nama && $jadwal['hari'] == $hari && $jadwal['jamPelajaran'] == $jamPelajaran) {
                // Jika ditemukan jadwal yang cocok, berarti guru tida tersedia
                return [
                    'status' => 'tidak tersedia',
                    'message' => 'Di hari ' . $jadwal['hari'] . ' jam pelajaran ke-' . $jadwal['jamPelajaran'] . ' '. $jadwal['guru'] . ' sedang mengajar mata pelajaran ' . $jadwal['mataPelajaran'] . ' di kelas ' . $jadwal['kelas']
                ];
            }
        }

        // Jika tidak ditemukan jadwal yang cocok, berarti guru tersedia ;
        return [
            'status' => 'tersedia',
            'message' =>  $nama . ' sedang tidak mengajar '
        ];
    }
}


