<?php
// get_image.php
// Example: http://localhost/myproject/public/get_image.php?file=img1.jpg

// 1️⃣ Define the secure directory
$imageDir = __DIR__ . '/../app/storage/images/';

// 2️⃣ Sanitize file name (prevent ../../ attacks)
$file = basename($_GET['file'] ?? '');

// 3️⃣ Build full path
$filePath = $imageDir . $file;

// 4️⃣ Security & existence checks
if (!$file || !file_exists($filePath)) {
    http_response_code(404);
    exit('Image not found');
}

// 5️⃣ Optional: access control (example)
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit('Unauthorized');
}

// 6️⃣ Output image safely
$mime = mime_content_type($filePath);
header("Content-Type: $mime");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit;

// Step 2: Use it in your HTML or PHP view
// <img src="<?= BASEURL; ?>/public/get_image.php?file=img1.jpg" alt="My Image">
