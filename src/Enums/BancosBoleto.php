<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 03/11/2018
 * Time: 19:41
 */

namespace Enums;

include_once ('EnumDefault.php');

abstract class BancosBoleto extends EnumDefault
{
    const SICREDI = 0;
    const IUGU = 1;


    static function toString($bco)
    {
        if ($bco == BancosBoleto::SICREDI) {
            return "Sicredi";
        } else if ($bco == BancosBoleto::IUGU) {
            return "Iugu";
        } else {
            return "";
        }
    }

    static function toStringSigla($bco)
    {
        if ($bco == BancosBoleto::SICREDI) {
            return "SIC";
        } else if ($bco == BancosBoleto::IUGU) {
            return "IUG";
        } else {
            return "";
        }
    }
}