<?php

class FileModel
{

    public function getFolderPath($folderName)
    {
        return BASE_PATH . "/uploads/" . $folderName;
    }


    public function folderExists($folderName)
    {
        $folderPath = $this->getFolderPath($folderName);
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
        $file['name'] = str_replace(' ','_',$file['name']);
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

    public function generateRandomKey()
    {
        $randomKey = $this->getRandomString();
        while($this->folderExists($randomKey))
        {
            $randomKey = $this->getRandomString();
        }
        return $randomKey;
    }

    private function getRandomString()
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
