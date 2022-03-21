<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 06/09/17
 * Time: 22:54
 */

namespace ctrl;

include_once "src/models/Usuarios.php";
include_once "Geral.php";

class UserCtrl
{

    public static function getObjetoUsuario_Login()
    {
        @session_start();
        if ($_SESSION['_usuario']) {
            return unserialize($_SESSION['_usuario']);
        } else {
            header("Location: login.php");
        }
    }

    public static function getObjetoEmpresa_Login()
    {
        @session_start();
        if ($_SESSION['_empresa']) {
            return unserialize($_SESSION['_empresa']);
        }
    }

    public static function validateAcessAuthorizedByPos($posAcesso)
    {
        if ( \Geral::$AcessoAdministrador){
            return true;
        } else if ($posAcesso == null) {
            return true;
        } else {
            $usuario = self::getObjetoUsuario_Login();
            if ($usuario != null) {
                if ($usuario->getAdministrador()=='S'){
                    return true;
                } else {
                    if ($usuario->getAcessos() != null) {
                        $strAcessos = $usuario->getAcessos();
                        if ($strAcessos != null) {
                            try {
                                if ($strAcessos[$posAcesso - 1] == "S") {
                                    return true;
                                }
                            } catch (Exception $e) {
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    public static function validateAcessAuthorizedForm($posAcesso)
    {
        if ( \Geral::$AcessoAdministrador){
            return true;
        } else if ($posAcesso == null) {
            return true;
        } else {
            $usuario = self::getObjetoUsuario_Login();
            if ($usuario != null) {
                if ($usuario->getAdministrador() == 'S') {
                    return true;
                } else {
                    $strAcessos = $usuario->getAcessos();
                    if ($strAcessos != null) {
                        try {
                            $userCtrl = new AccessUserCtrl();
                            if ($userCtrl->validatePosicaoInstalled($posAcesso)) {
                                if ($strAcessos[$posAcesso - 1] == "S") {
                                    return true;
                                }
                            } else {
                                header("location: access-denied-install.php");
                                die;
                            }
                        } catch (Exception $e) {
                        }
                    }
                }
            }
            header("location: access-denied.php");
            die;
        }
    }

}