<?php
/**
 * 이미지 목록을 반환하는 PHP 스크립트 (10개 폴더 지원)
 * 경로: plugins/stickers/images/ 로 부터 하위 폴더의 이미지를 가져옴 
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// 🎯 10개 폴더 허용 (순서대로)
$allowedFolders = array('sticker', 'smile');
$folder = isset($_GET['folder']) ? $_GET['folder'] : 'sticker';

// 보안: 허용된 폴더만 접근 가능
if (!in_array($folder, $allowedFolders)) {
    echo json_encode(array('error' => 'Invalid folder', 'requested' => $folder, 'allowed' => $allowedFolders));
    exit;
}

// 현재 파일의 경로를 구합니다.
$currentPath = dirname(__FILE__);

// 상대 경로를 사용하여 $imagesDir 설정
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
    
    // 파일명으로 정렬
    sort($images);
} else {
    // 폴더가 없으면 생성 잠시 무력화함 
    // @mkdir($imagesDir, 0755, true);
}

echo json_encode($images);
?>