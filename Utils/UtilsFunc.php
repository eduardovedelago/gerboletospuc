<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 24/01/2018
 * Time: 22:39
 */

function strToStrNumeros($value)
{
    return preg_replace("/\D+/", "", $value);
}

function strSpace($str, $tam)
{
    if (strlen($str) > $tam) {
        return substr($str, 0, $tam);
    } else {
        return str_pad($str, $tam);
    }
}

function space($tam)
{
    return str_repeat(' ', $tam);
}

function strZero($n, $tam)
{
    if (strlen($n . '') > $tam) {
        return substr($n, 0, $tam);
    } else {
        return str_pad($n . '', $tam , '0', STR_PAD_LEFT);
    }
}


function ZeroStr($n, $tam)
{
    if (strlen($n . '') > $tam){
        return substr($n, 0, $tam);
} else {
    return str_pad($n . '', $tam , '0', STR_PAD_LEFT);
}
}