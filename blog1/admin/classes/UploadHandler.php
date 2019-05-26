<?php
//declare(strict_types=1);
require_once 'UploadedFile.php';
class UploadHandler
{
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png'];
    private const MAX_FILE_SIZE = 500000;
    private const UPLOAD_DIR = UPLOADS_PATH;

    /**
     * @var UploadedFile
     */
    private $file;
    private $targetFilePath;
    private $targetFileName;

    /**
     * UploadHandler constructor.
     * @param $file
     */
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return bool
     */
    public function check() : bool {
        return ( !$this->file->getError() /*AND $this->file->isImage()*/ AND $this->ckeckExtension() AND $this->checkSize() );
    }

    /**
     * @return bool
     */
    public function ckeckExtension() : bool {
        $imageFileType = strtolower(pathinfo($this->file->getName(),PATHINFO_EXTENSION));
        return in_array($imageFileType, self::ALLOWED_EXTENSIONS);
    }

    /**
     * @return bool
     */
    public function checkSize() : bool {
        return $this->file->getSize() < self::MAX_FILE_SIZE ;
    }

    public function upload(){
        $this->targetFileName = $this->setUploadedFileName();
        $this->targetFilePath = self::UPLOAD_DIR . basename($this->targetFileName);
        move_uploaded_file($this->file->getTmpName(), $this->targetFilePath);
    }

    public function setUploadedFileName(){
        return md5(uniqid($this->file->getName())) . '.jpg';
    }

    /**
     * @return mixed
     */
    public function getTargetFileName()
    {
        return $this->targetFileName;
    }
}
