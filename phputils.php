<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 17/06/2018
 * Time: 12:41
 */

function formatFloat($value)
{
    try {
        if (value == null) {
            return "0,00";
        } else {
            setlocale(LC_MONETARY, "pt_BR");
            return number_format($value, 2, ",", ".");
        }
    } catch (Exception $exception) {
        return "0,00";
    }
}

function strToFloat($val)
{
    try {
        if ($val != null && strlen($val) > 0) {
            $val = strToStrNumerosValor($val);
            $val = str_replace(',', '.', $val);
            $val = trim($val);
            $val = floatval($val);
            return $val;
        } else {
            return 0;
        }
    } catch (Exception $exception) {
        return 0;
    }
}

function strToStrNumerosValor($val){
    $result = '';
    for ($i=0 ; $i<strlen($val);$i++){
        $valChar = $val[$i];
        if (strpos('0123456789,',$valChar)!==false){
            $result = $result . $valChar;
        }
    }
    return $result;
}