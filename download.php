<?php
$baseDir = __DIR__ . '/uploads/';
$filename = basename($_GET['file'] ?? '');

if ($filename === '') {
    http_response_code(400);
    exit('Missing file.');
}

$path = realpath($baseDir . $filename);
$baseReal = realpath($baseDir);

if (!$path || strpos($path, $baseReal) !== 0 || !is_file($path)) {
    http_response_code(404);
    exit('File not found.');
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Content-Length: ' . filesize($path));
readfile($path);
exit;
?>
