<?php

if (@session_id() == '') {
    @session_start();
}

require_once("lib/config.php");

//HTML - Contém funções para geração dos dados de HTML e JS que são inseridos nos Formulários
include_once("src/app/Html.php");


include_once( $_SERVER['DOCUMENT_ROOT'] ."/controller/AccessUserCtrl.php");
include_once( $_SERVER['DOCUMENT_ROOT'] ."/controller/UserCtrl.php");

include_once( $_SERVER['DOCUMENT_ROOT'] . "/phputils.php");


?>