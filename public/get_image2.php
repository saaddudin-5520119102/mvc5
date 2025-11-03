<?php
// Example usage: http://localhost/myproject/public/get_image.php?file=users/avatar1.png

// 1️⃣ Start session if you want access control
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     http_response_code(403);
//     exit('Unauthorized');
// }

// 2️⃣ Get requested file name (can include subfolders)
$file = $_GET['file'] ?? '';

// 3️⃣ Define base image directory
$imageDir = realpath(__DIR__ . '/../app/storage/images/');

// 4️⃣ Resolve real path of requested file
$filePath = realpath($imageDir . '/' . $file);

// 5️⃣ Security checks
// - Check if file exists
// - Check that file is actually inside imageDir (no directory traversal)
if (
    !$filePath ||
    strpos($filePath, $imageDir) !== 0 ||   // prevents "../../" attacks
    !file_exists($filePath)
) {
    http_response_code(404);
    exit('Image not found');
}

// 6️⃣ Serve the file
$mime = mime_content_type($filePath);
header("Content-Type: $mime");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit;


// Example Usage in HTML / PHP View:
// <img src="<?= BASEURL; ?>/public/get_image.php?file=users/avatar1.png" alt="User Avatar">

<!-- or if your image is directly inside storage/images: -->
<!-- <img src="<?= BASEURL; ?>/public/get_image.php?file=photo1.jpg" alt="Photo"> -->

