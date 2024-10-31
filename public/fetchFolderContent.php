<?php

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

include_once BASE_PATH . '/app/controller/FileController.php';

// Get folder name of URL
$folderName = isset($_GET['folderName']) ? $_GET['folderName'] : '';

$controller = new FileController();

$controller->getUpdateFiles($folderName);
