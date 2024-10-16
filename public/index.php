<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/app/controller/FileController.php';

$fileController = new FileController();
$fileController->index();