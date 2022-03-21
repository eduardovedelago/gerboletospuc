<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 16/08/17
 * Time: 13:27
 */

include_once($_SERVER['DOCUMENT_ROOT'] . "/controller/AccessUserCtrl.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/controller/UserCtrl.php");

require_once("../vendor/autoload.php");
include_once '../database.php';

// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\PendFin;
use models\PendFinBlt;


// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\PendFin";
$fieldNameInModal = "operacao";
$locationRedirAfter_Insert_Update = "./form-proc-baixar-blt.php";

// #####################################################
// ##
// ##         IF Method Request Is "POST"
// ##
// #####################################################


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['action'] == 'findOperacaoBaixa') {
        findOperacaoBaixa($entityManager);
    } else if ($_POST['action'] == 'executeBaixa') {
        executeBaixaBoleto($entityManager);
    }
}

/**
 * @param $entityManager
 */
function findOperacaoBaixa($entityManager)
{
    $erro = null;
    try {
        $primariKey = $_POST['operacao'];
        if ($primariKey > 0) {
            if ($entityManager != null) {
                $pendfin = $entityManager->getRepository('models\PendFin')->findOneBy(['operacao' => $primariKey]);
                if ($pendfin != null) {
                    $pendFinBlt = $entityManager->getRepository('models\PendFinBlt')->findOneBy(['operacao' => $pendfin->getOperacao()]);
                    $cliente = $entityManager->getRepository('models\Cliente')->findOneBy(['codigo' => $pendfin->getCodEntidade()]);
                    $statusValidacao = validaSituacaoPendFinBaixa($pendfin);
                    if ($statusValidacao == null) {
                        $arrayDados[] = (array)$pendfin;

                        if ($cliente != null) {
                            $arrayDados[] = (array)$cliente;
                        }

                        if ($pendFinBlt != null) {
                            $arrayDados[] = (array)$pendFinBlt;
                        }
                        $jsonPendfin = json_encode($arrayDados);
                        $jsonPendfin = str_replace("\u0000*\u0000", '', $jsonPendfin);
                        echo "OK " . $jsonPendfin;
                    } else {
                        echo $statusValidacao;
                    }
                } else {
                    $erro = "Dados não localizados";
                }
            } else {
                $erro = "Erro ao Utilizar o Controlador de Entidades, Null";
            }
        }
    } catch (Exception $exception) {
        $erro = $exception->getMessage();
    }
    if ($erro != null) {
        echo "Erro: " . $erro;
    }
}

function executeBaixaBoleto($entityManager)
{
    $erro = null;
    try {
        $primariKey = $_POST['operacao'];
        $primariKey2 = $_POST['operacao2'];
        $motivoBaixa = $_POST['motivobx'];
        $baixaManual = $_POST['baixaManual'];
        if (is_null($baixaManual)) {
            $baixaManual = "S";
        };
        if ($primariKey > 0) {
            if ($primariKey == $primariKey2) {
                if ($entityManager != null) {
                    $pendfin = $entityManager->getRepository('models\PendFin')->findOneBy(['operacao' => $primariKey]);
                    if ($pendfin != nul) {
                        $statusValidacao = validaSituacaoPendFinBaixa($pendfin);
                        if ($statusValidacao == null) {
                            if ($pendfin->getBoleto() == "S") {
                                $pendFinBlt = $entityManager->getRepository('models\PendFinBlt')->findOneBy(['operacao' => $pendfin->getOperacao()]);
                                if ($pendFinBlt != null) {
                                    if ($pendFinBlt->getInvoiceId() != null && $pendFinBlt->getInvoiceId() != "") {
                                        include_once("IuguCtrl.php");
                                        $ResultBaixaIugu = executeBaixaBltIugu($pendFinBlt->getInvoiceId());
                                        if ($ResultBaixaIugu == null) {
                                            $resUpdate = updatePendFinBaixada($entityManager, $pendfin, $baixaManual, $motivoBaixa, $pendFinBlt);
                                            if ($resUpdate == null) {
                                                echo "OK";
                                            } else {
                                                echo $resUpdate;
                                            }
                                        } else {
                                            echo "Falha ao Executar Baixa no emissor do Boleto <br> " . $ResultBaixaIugu;
                                        }
                                    } else {
                                        $resUpdate = updatePendFinBaixada($entityManager, $pendfin, $baixaManual, $motivoBaixa);
                                        if ($resUpdate == null) {
                                            echo "OK";
                                        } else {
                                            echo $resUpdate;
                                        }
                                    }
                                } else {
                                    echo "Falha ao Carregar dados do Boleto";
                                }
                            } else {
                                $resUpdate = updatePendFinBaixada($entityManager, $pendfin, $baixaManual, $motivoBaixa);
                                if ($resUpdate == null) {
                                    echo "OK";
                                } else {
                                    echo $resUpdate;
                                }
                            }
                        } else {
                            echo $statusValidacao;
                        }
                    } else {
                        $erro = "Dados não localizados";
                    }
                } else {
                    $erro = "Erro ao Utilizar o Controlador de Entidades, Null";
                }
            } else {
                $erro = "Dados Digitados Não Conferem, Verifique o que informado no campo Operação e Execute Novamente a Baixa";
            }
        }
    } catch (Exception $exception) {
        $erro = $exception->getMessage();
    }
    if ($erro != null) {
        echo "Erro: " . $erro;
    }
}


function validaSituacaoPendFinBaixa(PendFin $pendfin)
{
    if ($pendfin->getStatus() == "B") {
        return "Pendência Financeira Não pode ser Baixada, Já está Baixada";
    } else if ($pendfin->getStatus() == "C") {
        return "Pendência Financeira já foi Cancelada";
    } else if ($pendfin->getBoleto() != "S") {
        return "Pendência Financeira não é um Boleto";
    }
    return null;
}


function updatePendFinBaixada($entityManager, PendFin $pendfin, String $baixaManual, String $motivoBaixa, PendFinBlt $pendfinblt = null)
{
    try {
        if ($entityManager != null) {
            $usuario = \Ctrl\UserCtrl::getObjetoUsuario_Login();
            $usuaCanc = $usuario->getCodigo();
            $entityManager->getConnection()->beginTransaction();
            $pendfin->setStatus("B");
            $pendfin->setBaixaManual($baixaManual);
            $pendfin->setMotivoBaixa($motivoBaixa);
            $pendfin->setDataBaixa(new DateTime('now'));
            $pendfin->setUsuaBaixa($usuaCanc);
            $entityManager->merge($pendfin);
            $entityManager->flush();
            if ($pendfinblt != null) {
                $pendfinblt->setStatus("B");
                $entityManager->merge($pendfinblt);
                $entityManager->flush();
            }
            $entityManager->getConnection()->commit();
            return null;
        } else {
            $resultValidacao = "Erro ao Utilizar o Controlador de Entidades, Null";
        }
    } catch (Exception $exception) {
        $entityManager->getConnection()->rollBack();
        return "Exception: " . $exception->getMessage();
    }
    return $resultValidacao;
}

