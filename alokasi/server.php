<?php

class Guru {
    // Data statis jadwal guru dengan informasi kelas yang sedang diajar
    private $jadwalKelas = [
        ['guru' => 'Guru A', 'hari' => 'Senin', 'jamPelajaran' => 1, 'mataPelajaran' => 'Matematika', 'kelas' => 10],
        ['guru' => 'Guru B', 'hari' => 'Senin', 'jamPelajaran' => 2, 'mataPelajaran' => 'Kimia', 'kelas' => 11],
        ['guru' => 'Guru A', 'hari' => 'Selasa', 'jamPelajaran' => 2, 'mataPelajaran' => 'Fisika', 'kelas' => 11],
        ['guru' => 'Guru C', 'hari' => 'Kamis', 'jamPelajaran' => 1, 'mataPelajaran' => 'Biologi', 'kelas' => 10],
    ];

    // Fungsi untuk alokasi jadwal guru
    public function alokasiJadwalGuru($nama, $hariLama, $jamLama, $hariBaru, $jamBaru, $sistemBelajar) {
        // memeriksa jadwal guru
        foreach ($this->jadwalKelas as $key => $jadwal) {
            if ($jadwal['guru'] == $nama && $jadwal['hari'] == $hariLama && $jadwal['jamPelajaran'] == $jamLama) {
                // Jika ditemukan jadwal yang cocok, perbarui jadwal
                $this->jadwalKelas[$key] = [
                    'guru' => $nama,
                    'hari' => $hariBaru,
                    'jamPelajaran' => $jamBaru,
                    'mataPelajaran' => $jadwal['mataPelajaran'],
                    'kelas' => $jadwal['kelas']
                ];

                return [
                    'status' => 'success',
                    'message' => 'Jadwal berhasil diubah',
                    'sistem_belajar' => $sistemBelajar,
                    'keterangan' => "Jadwal diubah pada hari {$hariBaru} jam pelajaran ke-{$jamBaru} dengan pembelajaran {$sistemBelajar}."
                ];
            }
        }

        // Jika tidak ditemukan jadwal yang cocok
        return [
            'status' => 'error',
            'message' => 'Jadwal tidak ditemukan',
            'sistem_belajar' => $sistemBelajar,
            'keterangan' => 'Tidak ada perubahan jadwal karena guru tidak mengajar pada hari dan jam tersebut.'
        ];
    }
}
