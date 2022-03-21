<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 16/08/17
 * Time: 13:27
 */

require_once("../vendor/autoload.php");
INCLUDE_once("UserCtrl.php");
include_once '../database.php';
include_once "../phputils.php";
include_once("../boletophp/include/funcoes_sicredi.php");
include_once "../src/Enums/BancosBoleto.php";
include_once("IuguCtrl.php");
include_once("../src/models/Empresa.php");
include_once("../src/models/MovAntecipacao.php");
include_once("../src/models/PendFin.php");


// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\MovAntecipacao;
use models\PendFin;
use models\Empresa;

// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\MovAntecipacao";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-lcto-antecip.php";


// #####################################################
// ##
// ##         IF Method Request Is "POST"
// ##
// #####################################################

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // #####################################################
    // ##
    // ##                  DELETE
    // ##
    // #####################################################
    if ($_POST['action'] == 'delete') {

    }

    // #####################################################
    // ##
    // ##               INSERT /or UPDATE
    // ##
    // #####################################################


    if ($_POST['action'] == 'insert') {
        $result = "Erro Desconhecido";
        try {
            $entityManager->getConnection()->beginTransaction();
            if ($entityManager != null) {
                $operacoesAntecipar = $_POST['operacoes_antecipar'];
                if ($operacoesAntecipar!=null && strlen($operacoesAntecipar)>0) {
                    $transacao = Geral::getTransacao($entityManager);
                    $operacao = Geral::getOperacao($entityManager);
                    $empresa = getDadosEmpresa();
                    $empr_Codigo = $empresa->getCodigo();
                    $dataLcto = new DateTime('now');
                    $usuario = ctrl\UserCtrl::getObjetoUsuario_Login();
                    $usuaLcto = $usuario->getCodigo();
                    $valor = strToFloat($_POST['edValorBruto']);
                    $valorprev = strToFloat($_POST['edValorPrev']);
                    $movAntecipacao = new MovAntecipacao($transacao, $operacao, $dataLcto, $empr_Codigo, $valor, $valorprev, $usuaLcto);
                    $resultValidacao = validaDadosInsert($movAntecipacao);
                    if ($resultValidacao == null) {
                        $entityManager->persist($movAntecipacao);
                        $entityManager->flush();
                        $operacoesAntecipar = explode(",",$operacoesAntecipar);
                        for ($i = 0 ; $i<count($operacoesAntecipar);$i++){
                            $opquery = $operacoesAntecipar[$i];
                            if (trim($opquery)!='' && strlen(trim($opquery))>0) {
                                $pf = $entityManager->createQuery('SELECT u FROM models\PendFin u WHERE u.operacao='.$opquery)->getOneOrNullResult();
                                if ($pf != null) {
                                    $pf->setStatusAntecipacao('P');
                                    $pf->setTransacaoAntecipacao($transacao);
                                    $entityManager->merge($pf);
                                    $entityManager->flush();
                                }
                            }
                        }
                        $entityManager->getConnection()->commit();
                        $result = "success:" . str_pad($transacao, 12, "0", STR_PAD_LEFT);
                    } else {
                        $result = $resultValidacao;
                    }
                } else {
                    $resultValidacao = "Nenhuma operação selecionada para antecipação";
                }
            } else {
                $resultValidacao = "Erro ao Utilizar o Controlador de Entidades, Null";
            }
        } catch (Exception $exception) {
            $entityManager->getConnection()->rollBack();
            $result = "Exception: " . $exception->getMessage();
        }
        echo $result;
    }


    // #####################################################
    // ##
    // ##                  UPLOAD_FILE
    // ##
    // #####################################################
    if ($_POST['action'] == 'UPLOAD_FILE') {
        if (!uploadFile($_POST['transacao'])){
            echo "OK";
        } else {
            echo "ERRO";
        }
    }
}


// #####################################################
// ##
// ##               Funções
// ##
// #####################################################


// #####################################################
// ##
// ##               Upload Arquivos
// ##
// #####################################################

function uploadFile($transacao)
{
    $allowedTypes = array(
        'image/png',
        'image/gif',
        'image/jpeg',
        'image/bmp',
        'image/tiff',
        'application/zip',
        'text/plain',
        'application/xml',
        'application/pdf',
        'application/msword',
        'application/vnd.ms-excel'
    );

    $useFiles = array();

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    foreach ($_FILES as $index => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $type = $finfo->file($file['tmp_name']);
            if (in_array($type, $allowedTypes)) {
                $useFiles[$index] = $file;
            } else {
                $error = true;
            }
        }
    }

    //$data = array();

    if (isset($useFiles) && (sizeof($useFiles) > 0)) {
        $error = false;
        $files = array();

        $uploaddir = '../uploads/' . $transacao;
        if (!file_exists($uploaddir)) {
            mkdir($uploaddir, 0777, true);
        }
        $uploaddir = $uploaddir . '/';

        foreach ($useFiles as $file) {
            if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))) {
                $files[] = $uploaddir . $file['name'];
            } else {
                $error = true;
            }
        }
        //$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
    } else {
        //$data = array('success' => 'Form was submitted', 'formData' => $_POST);
    }
    return $error;
}

function getDadosEmpresa()
{
    try {
        return ctrl\UserCtrl::getObjetoEmpresa_Login();
    } catch (Exception $exception) {
    } catch (Error $error) {
    }
}



// #####################################################
// ##[alteracao]
// ##                    Validate
// ##
// #####################################################
function validaDadosInsert(MovAntecipacao $movantecip)
{
    $msgDefault = null;
    if ($movantecip == null) {
        return $msgDefault . "<br> Dados do Movimento Inválido, Null";
    }
    if ($movantecip->getStatus() == null || ($movantecip->getStatus() != "N")) {
        return $msgDefault . "<br> Status inválido";
    }
    if ($movantecip->getValor() <= 0) {
        return $msgDefault . "<br> Valor Inválido";
    }
    if ($msgDefault != null) {
        $msgDefault = "Validação de Dados: " . $msgDefault;
        return $msgDefault;
    }
    return null;
}
