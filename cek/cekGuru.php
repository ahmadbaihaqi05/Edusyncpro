<?php

$wsdl = "http://localhost/project/guru.wsdl"; 

try {
    
    $client = new SoapClient($wsdl);

    // mendapat input an JSON dari POST request
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (isset($input['nama_guru'], $input['hari'], $input['jam_pelajaran'])) {
        // memanggil SOAP method dengan parameter
        $result = $client->cekKetersediaanGuru(
            $input['nama_guru'],
            $input['hari'],
            $input['jam_pelajaran']
        );

        // mengembalikan hasil sebagai respons JSON
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        // mengembalikan kesalahan jika input an tidak lengkap
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Input tidak lengkap.']);
    }
} catch (Exception $e) {
    // menangani SOAP client jika eror
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Kesalahan: ' . $e->getMessage()]);
}
