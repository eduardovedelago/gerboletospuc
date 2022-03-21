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
//include_once("../boletophp/include/funcoes_sicredi.php");
//include_once "../src/Enums/BancosBoleto.php";
//include_once("IuguCtrl.php");
//include_once("../src/models/Empresa.php");
include_once("../src/models/MovAntecipacaoAnalise.php");
include_once("../src/models/PendFin.php");


// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\MovAntecipacaoAnalise;
use models\PendFin;
use models\Empresa;

// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\MovAntecipacao";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-lcto-antecip-analise.php";


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


    $result = "Erro Desconhecido";
    $resultValidacao = "";
    try {
        if ($entityManager != null) {
            $operacoesAntecipar = $_POST['operacoes'];
            if ($operacoesAntecipar != null && strlen($operacoesAntecipar) > 0) {
                $transacao = Geral::getTransacao($entityManager);
                $operacaoMvto = Geral::getOperacao($entityManager);
                $dataLcto = new DateTime('now');
                $dataMvto = new DateTime($_POST['dataMvto']);
                $valorMvto = strToFloat($_POST['valorMvto']);
                $valorRepasse = strToFloat($_POST['valorRepasse']);
                $numOcorrencias = (int)$_POST['numOcorrencias'];
                $numAprovados = (int)$_POST['numAprovados'];
                $numRejeitados = (int)$_POST['numRejeitados'];

                $usuario = ctrl\UserCtrl::getObjetoUsuario_Login();
                $usuaLcto = $usuario->getCodigo();

                $operacoesAntecipar = explode(",", $operacoesAntecipar);
                $codigoEmpresa = 0;
                if (count($operacoesAntecipar) > 0) {
                    $entityManager->getConnection()->beginTransaction();
                    for ($i = 0; $i < count($operacoesAntecipar); $i++) {
                        $opquery = $operacoesAntecipar[$i];
                        if (trim($opquery) != '' && strlen(trim($opquery)) > 0) {
                            $newStatus = getStatusAvaliacao($opquery);
                            if ($newStatus != null) {
                                $pf = $entityManager->createQuery('SELECT u FROM models\PendFin u WHERE u.operacao=' . $opquery)->getOneOrNullResult();
                                if ($pf != null) {
                                    $pf->setStatusAntecipacao($newStatus);
                                    $pf->setTransacaoAvaliacaoAntecipacao($transacao);
                                    $entityManager->merge($pf);
                                    $entityManager->flush();
                                    $codigoEmpresa = $pf->getEmprCodigo();
                                } else {
                                    $resultValidacao .= "Error: Falha ao carregar Operação da Pendência Financeira";
                                }
                            } else {
                                $resultValidacao .= "Error: Falha ao carregar Status de Antecipação";
                            }
                        }
                    }
                    if ($resultValidacao == null) {
                        $movAntecipacaoAnalise = new MovAntecipacaoAnalise($transacao, $operacaoMvto, $dataLcto, $dataMvto, $numOcorrencias, $numAprovados, $numRejeitados, $valorMvto, $valorRepasse, $usuario->getCodigo(), $codigoEmpresa);
                        $entityManager->persist($movAntecipacaoAnalise);
                        $entityManager->flush();
                        $entityManager->getConnection()->commit();
                        $result = "success:" . str_pad($transacao, 12, "0", STR_PAD_LEFT);
                    } else {
                        $entityManager->getConnection()->rollBack();
                        $result = $resultValidacao;
                    }
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
// ##               Funções
// ##
// #####################################################


function getStatusAvaliacao($operacao)
{
    $opcao = $_POST['inputStatusOP_' . $operacao];
    if ($opcao != 9) {
        if ($opcao == 1) {
            return "A";
        } else if ($opcao == 2) {
            return "R";
        }
    }
    return null;
}

