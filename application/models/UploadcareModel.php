<?php

    namespace App\Models;

    use Uploadcare\Interfaces\File\ModelInterface;

    class UploadcareModel implements ModelInterface
    {
    protected $config;

    public function __construct()
    {
        $this->config = config('uploadcare');
    }

    public function getFileInfo($fileId)
    {
        $api = new Uploadcare\Api($this->config);

        return $api->file()->getFileInfo($fileId);
    }
    }


?>