<?php

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

include_once BASE_PATH . '/app/controller/FileController.php';

// Obtener el nombre de la carpeta de la URL
$folderName = isset($_GET['nombre']) ? $_GET['nombre'] : '';

$controller = new FileController();
// Pasar el nombre de la carpeta al controlador
$controller->getUpdateFiles($folderName);
