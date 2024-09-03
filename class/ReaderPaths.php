<?php

class ReaderPaths {

    public static function loadPaths() {
        $filePath               = $_SESSION['_ROOT'].'paths.json';
        $json                   = file_get_contents($filePath);
        $config                 = json_decode($json, true);
        $_SESSION['_ZENDOR']    = $config['zendor'];
        $_SESSION['_MAILER']    = $config['phpMailer'];
    }

    public function loadApps() {
        $filePath               = $_SESSION['_ROOT'].'apps.json';
        $json                   = file_get_contents($filePath);
        $config                 = json_decode($json, true);
        return $config['apps'];
    }

}