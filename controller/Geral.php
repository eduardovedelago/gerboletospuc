<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 17/01/2018
 * Time: 15:26
 */

use Doctrine\ORM\Id\SequenceGenerator;

include_once($_SERVER['DOCUMENT_ROOT'] . "/src/Enums/BancosBoleto.php");
include_once("./src/Enums/BancosBoleto.php");

class Geral
{

    public static $AmbienteHomologacao = true;
    public static $homologationIsMAC = false;

    public static $AcessoAdministrador = false;
    public static $BANC_BLT = \Enums\BancosBoleto::IUGU;//Teste
    private static $IUGU_API_TOKEN_T = "4188e18f4cbe208a352840e216e74954";    

    public static function getTransacao($entityManager)
    {
        $sequenceName = 'pfin_transacao_seq';
        $sequenceGenerator = new SequenceGenerator($sequenceName, 1);
        return $sequenceGenerator->generate($entityManager, $entity);
    }

    public static function getOperacao($entityManager)
    {
        $sequenceName = 'pfin_Operacao_seq';
        $sequenceGenerator = new SequenceGenerator($sequenceName, 1);
        return $sequenceGenerator->generate($entityManager, $entity);
    }

    public static function getNossoNumero($entityManager)
    {
        $sequenceName = 'pblt_nossoNumero_seq';
        $sequenceGenerator = new SequenceGenerator($sequenceName, 1);
        return $sequenceGenerator->generate($entityManager, $entity);
    }

    public static function getApiTokenIUGU()
    {        
        return Geral::$IUGU_API_TOKEN_T;        
    }

    public static function getParametersConnectionDataBase()
    {       

        $dbParamsLocaWeb_PostgreSQL = array(
            'driver' => 'pdo_pgsql',
            'user' => 'gerboletos',
            'password' => 'gerb..11pux',
            'host' => '179.188.16.113',
            'dbname' => 'gerboletos'
        );
        
        return $dbParamsLocaWeb_PostgreSQL;
    }

}