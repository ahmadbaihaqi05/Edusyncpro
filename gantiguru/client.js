$(() => {
    $('#gantiguruForm').on('submit', (e) => {
        e.preventDefault(); // Mencegah reload halaman

        // Ambil data dari form
        const data = {
            namaGuruLama: $('#namaGuruLama').val(),
            namaGuruBaru: $('#namaGuruBaru').val(),
            hari: $('#hari').val(),
            jamPelajaran: $('#jamPelajaran').val(),
        };

        console.log('Data yang dikirim:', data); // Debugging untuk melihat data yang dikirim

        // Kirim data menggunakan AJAX
        $.ajax({
            url: 'gantiGuru.php', // Endpoint middleware
            method: 'POST',
            contentType: 'application/json', // Format data
            data: JSON.stringify(data), // Data dikirim dalam format JSON
        })
        .done((result) => {
            // menangani respon dari server
            let html = '';
            if (result.error) {
                html = `<p>Error: ${result.error}</p>`;
            } else {
                html = `<p>Status: ${result.status}</p>`;
                html += `<p>Message: ${result.message}</p>`;
            }
            $('#result').html(html);
        })
        .fail(() => {
            // Handle errors during the AJAX request
            $('#result').html('<p>Terjadi kesalahan saat memproses data.</p>');
        });
    });
});
