<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 23/07/2018
 * Time: 09:17
 */

//if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/inc/init.php")) {
//    include_once($_SERVER['DOCUMENT_ROOT'] . "/inc/init.php");
//    include_once($_SERVER['DOCUMENT_ROOT'] . "/inc/config.ui.php");
//} else {
    //include_once('../inc/init.php');
    //include_once('../inc/config.ui.php');
require_once("../vendor/autoload.php");
//}

include_once($_SERVER['DOCUMENT_ROOT'] . "/controller/AccessUserCtrl.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/controller/UserCtrl.php");

include_once("../src/models/Empresa.php");
include_once("../src/models/PendFin.php");
include_once("../src/models/PendFinBlt.php");
include_once("../src/models/Cliente.php");
include_once($_SERVER['DOCUMENT_ROOT'] . '/Utils/UtilsFunc.php');

include_once '../database.php';

use models\Cliente;
use models\PendFin;
use models\PendFinBlt;

$file = '../ib/expfiles/';

chmod($_SERVER['DOCUMENT_ROOT'], 0755);
//if (!file_exists($file)) {
//    mkdir($file, 0755, true);
//}
$file = $file . 'SicrediIB.txt';

$empresa = ctrl\UserCtrl::getObjetoEmpresa_Login();
$qb = $entityManager->createQueryBuilder();

if ($qb != null) {

    $qb->select('p.transacao', 'p.operacao', 'p.codEntidade', 'p.status', 'p.dataVcto', 'p.dataMvto', 'p.parcela', 'p.numParcelas', 'p.valor', 'p.numeroDcto', 'p.email',
        'c.codigo', 'c.nome', 'c.cnpjCpf', 'c.cep', 'c.endereco',
        'b.nossoNumeroBlt'
    )
        ->from('models\PendFin', 'p')
        ->innerJoin('models\PendFinBlt', 'b', 'WITH', 'b.operacao = p.operacao')
        ->innerJoin('models\Cliente', 'c', 'WITH', 'c.codigo = p.codEntidade')
        ->where('p.empr_Codigo = :empresa')
        ->setParameter('empresa', $empresa->getCodigo())
        ->andWhere('b.statusExp = :statusexp')
        ->setParameter('statusexp', 'P')
        ->andWhere('b.banco = :banco')
        ->setParameter('banco', 'SIC');

    $dadosResult = $qb->getQuery()->getResult();
    if (sizeof($dadosResult)) {

        $countResgistro = 1;
        $arquivo = '';
        $line = '' .
            '0' .
            '1' .
            'REMESSA' .
            '01' .
            strSpace('COBRANCA', 15) .
            '39164' .
            '12426126000101' .
            space(31) .
            '748' .
            strSpace('SICREDI', 15) .
            date("Ymd", (new DateTime('now'))->getTimesTamp()) .
            space(8) .
            '0000001' .
            space(273) .
            '2.00' .
            strZero($countResgistro, 6);
        $arquivo = $arquivo . $line . "\r\n";

        foreach ($dadosResult as $dadosObj) {
            $countResgistro++;
            $line = '' .
                '1' .
                'A' .
                'A' .
                'A' .
                space(12) .
                'A' .
                'B' .
                'B' .
                space(28) .
                Zerostr(str_replace("-","", str_replace("/","",$dadosObj['nossoNumeroBlt'])), 9) .
                space(6) .
                date("Ymd", (new DateTime('now'))->getTimesTamp()) .
                ' ' .
                'N' .
                ' ' .
                'B' .
                ZeroStr($dadosObj['parcela'], 2) .
                ZeroStr($dadosObj['numParcelas'], 2) .
                space(4) .
                ZeroStr('0', 10) .
                '0000' .
                space(12) .
                '01' .
                strSpace($dadosObj['operacao'], 10) .
                $dadosObj['dataVcto']->format('dmy') .
                ZeroStr(number_format($dadosObj['valor'], 2, '', ''), 13) .
                space(9) .
                'A' .
                'S' .
                $dadosObj['dataMvto']->format('dmy') .
                '06' .
                '05' .
                ZeroStr(number_format(0.00, 2, '', ''), 13) .
                '000000' .
                ZeroStr(number_format(0.00, 2, '', ''), 13) .
                ZeroStr(number_format(0.00, 2, '', ''), 13) .
                ZeroStr(number_format(0.00, 2, '', ''), 13);
            if (sizeof(strToStrNumeros($dadosObj['cnpjCpf'])) == 11) {
                $line = $line . '1';
            } else {
                $line = $line . '2';
            }
            $line = $line .
                '0' .
                ZeroStr(strToStrNumeros($dadosObj['cnpjCpf']), 14) .
                strSpace($dadosObj['nome'], 40) .
                strSpace($dadosObj['endereco'], 41) .
                '00000' .
                '000000' .
                ' ' .
                strZero(strToStrNumeros($dadosObj['cep']), 8) .
                ZeroStr($dadosObj['codigo'], 5) .
                space(14) .
                space(41) .
                strZero($countResgistro, 6);
            $arquivo = $arquivo . $line . "\r\n";

        }

        $countResgistro++;
        $line = '' .
            '9' .
            '1' .
            '748' .
            '39164' .
            space(384) .
            strZero($countResgistro, 6);
        $arquivo = $arquivo . $line;

        $fHandle = fopen($file, 'w+');
        fwrite($fHandle, $arquivo);
        fclose($fHandle);


        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=sicredi.txt");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
        header("Expires: 0");
        readfile($file);
    } else {
        header("Location: /index.php?error=Nenhum Registro Localizado");
    }
}