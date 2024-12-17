$(() => {
    $('#checkForm').on('submit', (event) => {
        event.preventDefault();
        // mengumpulkan data dari form
        let data = {
            nama_guru: $('#nama_guru').val(),
            hari: $('#hari').val(),
            jam_pelajaran: $('#jam_pelajaran').val()
        };

        // mengirimkan data ke middleware menggunakan ajax
        $.ajax({
            url: 'cekGuru.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data) // Convert data ke JSON
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
            $('#result').html('<p>Terjadi kesalahan saat memproses data.</p>');
        });
    });
});
