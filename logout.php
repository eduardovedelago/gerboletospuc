<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 06/09/17
 * Time: 23:15
 */

@session_start();
$_SESSION['_sessionAuthenticated'] = null;

unset($_SESSION['_usuario']);
unset($_SESSION['_sessionAuthenticated']);

@session_unset();
$_SESSION = Array();
@session_destroy();

header('Location: /login.php');