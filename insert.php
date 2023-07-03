<?php
require __DIR__ . '/vendor/autoload.php';

// Configurações do Google Sheets
$spreadsheetId = 'seu_spreadsheet_id';
$range = 'A1:F1';  // Ajuste conforme necessário

$client = new \Google_Client();
$client->setApplicationName('Kakeibo');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');

$sheets = new \Google_Service_Sheets($client);

$values = [
    'values' => [
        $_POST['dataHora'],
        $_POST['nomeLoja'],
        $_POST['descricaoCompra'],
        $_POST['valorCompra'],
        $_POST['valorTotal'],
        $_POST['observacoes'],
    ],
];

$requestBody = new Google_Service_Sheets_ValueRange($values);

$response = $sheets->spreadsheets_values->append($spreadsheetId, $range, $requestBody, ['valueInputOption' => 'USER_ENTERED']);
?>
