<?php

class UploadedFile
{
    const FILE_ARRAY_KEYS = ["name", "type", "tmp_name", "error", "size"];

    private $name;
    private $type;
    private $tmp_name;
    private $error;
    private $size;

    /**
     * UploadedFile constructor.
     */
    public function __construct( array $httpFile )
    {
        if($this->isHttpFile($httpFile)){
            extract($httpFile);
            $this->name = $name;
            $this->type = $type;
            $this->tmp_name = $tmp_name;
            $this->error = $error;
            $this->size = $size;
        }
    }

    /**
     * @return bool
     */
    private function isHttpFile($httpFile) : bool {
        return empty(array_diff(array_keys($httpFile), self::FILE_ARRAY_KEYS));
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTmpName()
    {
        return $this->tmp_name;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

}