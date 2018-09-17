<?php

function compressImage($image_path) {
    if(!is_file($image_path)) {
        return false;
    }
    $ch = curl_init('https://tinypng.com/web/shrink');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $file = fopen($image_path, 'r');
    curl_setopt($ch, CURLOPT_POSTFIELDS, fread($file, filesize($image_path)));
    fclose($file);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);
    return $response;
}

echo json_encode(compressImage('sample_image.png'));
