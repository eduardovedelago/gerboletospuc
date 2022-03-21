<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 06/09/17
 * Time: 21:09
 */


require_once("vendor/autoload.php");

session_start();
if (!$_SESSION['_sessionAuthenticated']) {
    header('Location: /login.php');
    die;
}

?>