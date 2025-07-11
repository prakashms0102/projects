<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

function convertToJson($filePath, $extension)
{
    $data = [];

    if ($extension === 'csv') {
        if (($handle = fopen($filePath, 'r')) !== false) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
    } else {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        $header = array_shift($rows);
        foreach ($rows as $row) {
            $data[] = array_combine($header, $row);
        }
    }

    return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileTmp  = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $ext      = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, ['csv', 'xls', 'xlsx'])) {
        die('Unsupported file type.');
    }

    $jsonData = convertToJson($fileTmp, $ext);

    // Set headers to download JSON file
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="'.$fileName.'".json"');
    echo $jsonData;
    exit;
} else {
    echo "No file uploaded.";
}
