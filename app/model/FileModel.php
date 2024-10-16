<?php

class FileModel
{

    /* public function getFolderPath($folderName)
    {
        return BASE_PATH . "/uploads/" . $folderName;
    }


    public function folderExists($folderName)
    {
        $folderPath = $this->getFolderPath($folderName);
        return file_exists($folderPath);
    } */

    public function getFolderPath($folderName)
    {
        $folderPath = BASE_PATH . "/uploads/" . $folderName;
        $realPath = realpath($folderPath);

        // Mostrar la ruta absoluta y la ruta que se está intentando verificar
        echo "Folder Path: " . $folderPath . "<br>";
        echo "Real Path: " . $realPath . "<br>";

        return $folderPath;
    }
    
    public function folderExists($folderName)
    {
        $folderPath = $this->getFolderPath($folderName);
        // Debugging: Verifica si la ruta se está resolviendo correctamente
        echo "Checking if folder exists at: " . $folderPath . "<br>";
        return file_exists($folderPath);
    }



    public function createFolder($folderName)
    {
        $folderPath = $this->getFolderPath($folderName);
        if (!mkdir($folderPath, 0755, true))
        {
            throw new Exception("Error al crear la carpeta.");
        }
        return true;
    }

    public function getFiles($folderName)
    {

        $folderPath = $this->getFolderPath($folderName);
        return array_diff(scandir($folderPath), array('.', '..'));
    }

    public function fileUpload($folderName, $file)
    {
        $folderPath = $this->getFolderPath($folderName);
        return move_uploaded_file($file['tmp_name'], $folderPath . '/' . $file['name']);
    }

    public function fileDelete($folderName, $file)
    {
        $folderPath = $this->getFolderPath($folderName);
        $filePath = $folderPath . '/' . $file;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

    public function getRandomString()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomCharacter = $characters[mt_rand(0, strlen($characters) - 1)];
            $randomString .= $randomCharacter;
        }
        return $randomString;
    }
}
