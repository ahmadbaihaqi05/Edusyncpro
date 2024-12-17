$(document).ready(() => {
    $('#checkForm').on('submit', (e) => {
        e.preventDefault(); 

        // mengambil data dari form
        const data = {
            nama_guru: $('#nama_guru').val(),
            hari_lama: $('#hari_lama').val(),
            jam_lama: $('#jam_lama').val(),
            hari_baru: $('#hari_baru').val(),
            jam_baru: $('#jam_baru').val(),
            sistem_belajar: $('#sistem_belajar').val()
        };

        // mengirim data menggunakan AJAX
        $.ajax({
            url: 'http://localhost/edusyncpro/alokasi/alokasiGuru.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: (response) => {
                // menampilkan hasil di halaman
                $('#output').html(`
                    <p>Status: ${response.status}</p>
                    <p>Message: ${response.message}</p>
                `);
            },
            error: (xhr, status, error) => {
                // menampilkan pesan error jika gagal
                $('#output').html(`
                    <p>Error: ${error}</p>
                    <p>Status: ${xhr.status}</p>
                    <p>Response: ${xhr.responseText}</p>
                `);
            }
        });
    });
});
