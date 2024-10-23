<?php

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__, 2));
}

require_once BASE_PATH . '/app/model/FileModel.php';

class FileController
{
    private $model;

    public function __construct()
    {
        $this->model = new FileModel();
    }
    
    private function getCurrentUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        return "$protocol://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    }

    public function index()
    {
        $folderName = $this->getCurrentFolderName();

        if(!$this->model->folderExists($folderName))
        {
            $this->model->createFolder($folderName);
        }

        $this->handlePostRequest($folderName);
        
        $this->renderView('main', [
            'folderName' => $folderName
        ]);
    }

    private function getFolderName($currentUrl)
    {
        if(isset($_GET['nombre']))
        {
            $folderName = $_GET['nombre'];
        }
        else
        {
            $folderName = $this->model->getRandomString();
            $updateUrl = $currentUrl . "?nombre=" . $folderName;
            header("Location: $updateUrl");
            exit;
        }
        return $folderName;
    }

    private function handlePostRequest($folderName)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (isset($_FILES['files']))
            {
                $this->handleFileUpload($folderName);
            }

            if (isset($_POST['delete-file']))
            {
                $this->handleFileDelete($folderName);
            }
            
        }
    }

    private function handleFileUpload($folderName)
    {
        $files = $_FILES['files'];
        $uploadErrors = false;


        for ($i = 0; $i < count($files['name']); $i++)
        {
            $file = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            ];

            if ($file['error'] !== UPLOAD_ERR_OK)
            {
                $uploadErrors = true;
                echo "Error al subir el archivo {$file['name']}: " . $file['error'];
                continue;
            }

            $result = $this->model->fileUpload($folderName, $file);

            if (!$result)
            {
                $uploadErrors = true;
            }
        }
        if($uploadErrors)
        {
            echo "Error al subir un archivo.";
        }
        
    }

    private function handleFileDelete($folderName)
    {
        if (!$this->model->fileDelete($folderName, $_POST['delete-file']))
        {
            echo "Error al eliminar el archivo.";
        }
    }

    private function renderView($viewName, $data = [])
    {
        extract($data);
        require_once BASE_PATH . '/app/view/' . $viewName . '.php';
    }

    public function getUpdateFiles($folderName)
    {
        if(!empty($folderName))
        {
            $folderPath = $this->model->getFolderPath($folderName);
            $folderFiles = $this->model->getFiles($folderName);
            $this->renderView('fileList', [
                'folderPath' => $folderPath,
                'folderFiles' => $folderFiles
            ]);
        }
        else
        {
            echo 'No existe el folder nombrado';
        }
    }

    private function getCurrentFolderName()
    {
        $currentUrl = $this->getCurrentUrl();
        return $this->getFolderName($currentUrl);
    }

}