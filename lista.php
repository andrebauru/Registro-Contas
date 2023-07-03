<?php
require __DIR__ . '/vendor/autoload.php';

// Configurações do Google Sheets
$spreadsheetId = 'seu_spreadsheet_id';
$range = 'A1:F1000';  // Ajuste conforme necessário

$client = new \Google_Client();
$client->setApplicationName('Kakeibo');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');

$sheets = new \Google_Service_Sheets($client);

$response = $sheets->spreadsheets_values->get($spreadsheetId, $range);

$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        // Mostra cada coluna na linha
        echo implode(', ', $row);
    }
}
?>
