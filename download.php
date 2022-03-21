<?php
$transacao = trim($_GET['transacao']);
$file = basename($_GET['file']);
$pagecall =  trim($_GET['page_call']);
$file = 'uploads/' . $transacao . '/' . $file;

if (!file_exists($file)) { // file does not exist
    if ($pagecall!=null && $pagecall!=''){
        header('Location: '.$pagecall);
    } else {
        header('Location: index.php');
    }
    die;
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
    header("Pragma: no-cache");
    header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
    header("Expires: 0");
    readfile($file);
    //flush();
}

?>


