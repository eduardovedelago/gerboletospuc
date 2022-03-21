<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 08/09/17
 * Time: 20:28
 */

class FileUtils
{

    public static function saveContentToFile($fileName, $content)
    {
        $myfile = fopen($fileName, "w") or die("Falha ao abrir o Arquivo!");
        fwrite($myfile, $content);
        fclose($myfile);
    }
}