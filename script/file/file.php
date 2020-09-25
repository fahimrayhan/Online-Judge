<?php
class File
{

    public $userUploadFilePath = "user_file/user_upload/";
    public function __construct()
    {
        $this->DB   = new Database();
        $this->conn = $this->DB->conn;
        $this->Hash = new SiteHash();
    }

    public function getUserFileList()
    {
        $userId = $this->DB->isLoggedIn;
        $sql    = "select * from file_upload where userId=$userId order by fileUploadId DESC";
        $info   = $this->DB->getData($sql);
        return $info;
    }

    public function uploadFile($fileInfo)
    {
        if ($this->DB->userRole > 30) {
            return;
        }

        $userId = $this->DB->isLoggedIn;

        $insertData              = array();
        $insertData['userId']    = $userId;
        $insertData['addedDate'] = $this->DB->date();
        $response                = $this->DB->pushData("file_upload", "insert", $insertData, true);
        $response                = json_decode($response, true);
        $fileId                  = $response['insert_id'];

        $fileExplode    = explode('.', $fileInfo["file"]["name"]);
        $fileExt        = end($fileExplode);
        $fileName       = $this->Hash->userUplaodFile($fileId) . ".$fileExt";
        $uploadLocation = $this->userUploadFilePath . $fileName;
        move_uploaded_file($fileInfo["file"]["tmp_name"], $uploadLocation);
        $data                 = array();
        $data['fileUploadId'] = $fileId;
        $data['fileName']     = $fileName;
        $data['filePath']     = $uploadLocation;
        $data['fileType']     = $fileExt;
        $data['fileSize']     = $fileInfo['file']['size'];
        return $this->DB->pushData("file_upload", "update", $data, true);
    }

    public function updateUserUploadFilePath()
    {
        $userInfo = $this->getUserFileList();
        $newPath  = $this->userUploadFilePath;
        foreach ($userInfo as $key => $value) {
            $filePath                   = $value['filePath'];
            $filePath                   = explode('/', $filePath);
            $fileName                   = $filePath[count($filePath) - 1];
            $newFileName                = $newPath . $fileName;
            $updateData                 = array();
            $updateData['fileUploadId'] = $value['fileUploadId'];
            $updateData['filePath']     = $newFileName;
            $this->DB->pushData("file_upload", "update", $updateData);
        }
    }

    public function deleteFile($filePath)
    {
        $data = array();
        unlink($filePath);
        $data['filePath'] = $filePath;
        return $this->DB->pushData("file_upload", "delete", $data, true);
    }

    public function getCsvToArray($csvfile)
    {

        $csv   = array();
        $csv['data'] = array();

        $lines = file($csvfile, FILE_IGNORE_NEW_LINES);

        $keyList = array();

        foreach ($lines as $key => $value) {
            $data = str_getcsv($value);

            if ($key == 0) {
                $keyList        = $data;
                $csv['dataKey'] = $keyList;
            } 
            else {
                $tmpData = array();
                foreach ($data as $key => $value) {
                    $tmpKey           = isset($keyList[$key]) ? $keyList[$key] : rand();
                    $tmpData[$tmpKey] = $value;
                }
                array_push($csv['data'], $tmpData);
            }
        }

        return $csv;
    }

}
