<?php
$wsdl = "http://localhost/gantiguru/guru.wsdl";

$client = new SoapClient($wsdl);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $response = $client->__soapCall('GantiGuru', [
        [
            'namaGuruLama' => $data['namaGuruLama'],
            'namaGuruBaru' => $data['namaGuruBaru'],
            'hari' => $data['hari'],
            'jamPelajaran' => $data['jamPelajaran'],
        ]
    ]);

    header('Content-Type: application/json');
    echo json_encode($response);
}

