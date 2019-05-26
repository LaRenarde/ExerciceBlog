<?php

abstract class AbstractController
{
    const VIEWS_FOLDER = "views/";
    protected $model;

    protected function renderView(string $file, array $datas = null){
        if($datas != null) extract($datas);
        ob_start();
        include self::VIEWS_FOLDER . $file;
        $content = ob_get_clean();
        include self::VIEWS_FOLDER . "base.php";
    }
}