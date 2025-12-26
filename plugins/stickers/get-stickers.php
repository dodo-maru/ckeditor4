<?php
/**
 * stickers v3.0 by dodomaru
 * Put your's stickers images in plugins/stickers/images/stickers & smile Folder 
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$allowedFolders = array('sticker', 'smile');
$folder = isset($_GET['folder']) ? $_GET['folder'] : 'sticker';

if (!in_array($folder, $allowedFolders)) {
    echo json_encode(array('error' => 'Invalid folder', 'requested' => $folder, 'allowed' => $allowedFolders));
    exit;
}


$currentPath = dirname(__FILE__);
$imagesDir = $currentPath . '/images/' . $folder . '/';

$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'bmp');
$images = array();

if (is_dir($imagesDir)) {
    $files = scandir($imagesDir);
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        
        $filePath = $imagesDir . $file;
        
        if (is_file($filePath)) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            if (in_array($extension, $allowedExtensions)) {
                $images[] = $file;
            }
        }
    }
    
    sort($images);
} else {
    @mkdir($imagesDir, 0755, true);
}

echo json_encode($images);
?>
