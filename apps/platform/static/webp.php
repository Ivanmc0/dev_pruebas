<?php
// ubicacion
// $dir = './';

ini_set('max_execution_time', 0); // for infinite time of execution

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function readd ($dir){

    foreach (glob($dir.'/*.{png,jpeg,jpg,PNG,JPEG,JPG}', GLOB_BRACE) as $file) {

        $formato = explode('.', $file);

        $formato = end($formato);

        if ($formato == 'png' || $formato == 'PNG') $img = imagecreatefrompng($file);

        if ($formato == 'jpeg'|| $formato == 'jpg' || $formato == 'JPEG'|| $formato == 'JPG') $img = imagecreatefromjpeg($file);

        $comparar = preg_replace('/\\.[^.\\s]{3,5}$/', '', $file);

        if (!file_exists($comparar . '.webp')) {
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
            if ($formato == 'png' || $formato == 'PNG') imagewebp($img, preg_replace('/\\.[^.\\s]{3,5}$/', '', $file) . '.webp', 100);
            else                                        imagewebp($img, preg_replace('/\\.[^.\\s]{3,5}$/', '', $file) . '.webp', 75);
            imagedestroy($img);
        }

       //unlink($file); // elimina la fuente
    }
}


foreach(glob('*', GLOB_ONLYDIR) as $dir) {

    echo "<hr>".$dir;

    readd($dir);

    foreach(glob($dir.'/*', GLOB_ONLYDIR) as $dir2) {

        echo "<hr>-----".$dir2;
        readd($dir2);

    }


}

?>