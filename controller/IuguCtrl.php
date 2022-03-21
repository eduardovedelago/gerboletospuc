<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 30/10/2018
 * Time: 22:29
 */

include_once "Geral.php";
Include_once("../src/models/IuguChargeModel.php");
Include_once("../src/models/IuguAddressModel.php");
Include_once("../src/models/IuguPayerModel.php");
Include_once("../src/models/IuguItemsChargeModel.php");
include_once("../src/models/IuguResultRequest.php");
Include_once("../vendor/mashape/unirest-php/src/Unirest.php");
include_once("../src/models/Cliente.php");
include_once("../src/models/Municipio.php");
include_once("./UserCtrl.php");


use models\Cliente;
use models\Municipio;
use models\IuguPayerModel;


// #####################################################
// ##
// ##
// ##
// #####################################################

function processaResponseIugu($response)
{
    $response->code;        // Código HTTP do status da requisição
    $result = new \models\IuguResultRequest();
    if ($response != null) {
        $result->setSuccess($response->code == 200);
        $result->setBody($response->body);
        if (!$result->isSuccess()) {
            if ($response->body != null && ($response->body->errors) != null && count(get_object_vars($response->body->errors)) > 0) {
                $strErr = "";
                foreach (get_object_vars($response->body->errors) as $value) {
                    $strErr .= convertKeyIugoToUserText(key($response->body->errors)) . $value[0];
                }
                $result->setErrors($strErr);
            } else {
                $result->setErrors($response->code);
            }
        }
    }
    return $result;
}

function executeGeracaoBltIugu(Cliente $cliente, Municipio $municipio, $operacao, $numDiasVcto, $valor, $descricao, $dataMvto)
{
    $charge = loadDadosChargeIugu($cliente, $municipio, $operacao, $numDiasVcto, $valor, $descricao, $dataMvto);
    $response = callIuguGeracaoBlt($charge);
    $result = processaResponseIugu($response);
    if ($response->code == 200) {
        $result->setSuccess($response->body->success);
    }
    if ($result->isSuccess()) {
        $result->setIdentification($response->body->identification);
        $result->setInvoiceId($response->body->invoice_id);
        $result->setUrl($response->body->url);
        $result->setPdf($response->body->pdf);
    }
    return $result;
}


function callIuguGeracaoBlt($charge)
{
    $url = "https://api.iugu.com/v1/charge?api_token=" . \Geral::getApiTokenIUGU();
    $headers = array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    );
    $query = json_encode($charge);

    \Unirest\Request::verifyPeer(false);
    $response = \Unirest\Request::post($url, $headers, $query);
    return $response;
}

function callIuguConsultaListaFaturasAlteradas($dataConsulta, $start, $limit)
{
    if ($dataConsulta == null) {
        throw new Exception("Data de Consulta Null Não foi possível realizar o processamento");
    }
    //updated_since
    //Registros atualizados desde o momento passado no parâmetro. Formato (AAAA-MM-DDThh:mm:ss-03:00)
    //2019-02-12T00:00:00-03:00
    $dataConsulta = $dataConsulta->format('Y-m-d');
    $url = "https://api.iugu.com/v1/invoices?start=".$start."&limit=".$limit."&updated_since=" . $dataConsulta . "T00%3A00%3A00-03%3A00&api_token=" . \Geral::getApiTokenIUGU();
    $headers = array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    );

    \Unirest\Request::verifyPeer(false);
    $response = \Unirest\Request::get($url, $headers);
    return $response;
}

function validaResponseBoletoCallCancell($idCancelamento, $response)
{
    $strErr = "";
    if (($response != null) && ($response->code == 200)) {
        if ($response->body != null) {
            if ($response->body->errors != null) {
                if (count(get_object_vars($response->body->errors)) > 0) {
                    foreach (get_object_vars($response->body->errors) as $value) {
                        $strErr .= convertKeyIugoToUserText(key($response->body->errors)) . $value[0];
                    }
                    return $strErr;
                }
            } else {
                if ($response->body->status != null && strtoupper($response->body->status) == "CANCELED") {
                    return null;
                } else if ($response->body->status != null && strtoupper($response->body->status) == "EXPIRED") {
                    return null;
                } else {
                    $strErr == "Falha ao Executar Cancelamento";
                }
            }
        }
    } else if (($response != null) && ($response->code == 400)) {
        if ($response->body != null && $response->body->errors != null) {
            if (count(get_object_vars($response->body->errors)) > 0) {
                foreach (get_object_vars($response->body->errors) as $value) {
                    $strErr .= convertKeyIugoToUserText(key($response->body->errors)) . $value[0];
                }
                return $strErr;
            }
        }
    } else if ($response->code == 404 && $response->body->errors == "Invoice Not Found") {
        $strErr .= "Falha ao ao executar Cancelamento, Dados não localizados na IUGU, Consulte o Administrador do Sistema";
    }
    if ($strErr == "") {
        return "Falha ao executar cancelamento, Não foi possível identificar o erro.";
    } else {
        return $strErr;
    }
}

function executeCancelamentoBltIugu($idCancelamento)
{
    if ($idCancelamento != null && $idCancelamento != "") {
        $response = callIuguCancelamentoBlt($idCancelamento);
        $resultprocess = validaResponseBoletoCallCancell($idCancelamento, $response);
        if ($resultprocess == null) {
            return null;
        } else {
            $response = callIuguConsultaBoleto($idCancelamento);
            if ($response->code == 200 && $response->body != null && $response->body->errors == null) {
                include_once("IuguProcessaStatus.php");
                $fatura = getObjectFaturaIugu(array($response->body)[0]);
                $status = getStatusByFatura($fatura);
                if ($status == "C") {
                    return null;
                }
            }
            return $resultprocess;
        }
    } else {
        return "Código Identificador na Iugu Não localizado,";
    }
}

function callIuguCancelamentoBlt($idCancelamento)
{
    $url = "https://api.iugu.com/v1/invoices/" . $idCancelamento . "/cancel?api_token=" . \Geral::getApiTokenIUGU();
    $headers = array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    );
    \Unirest\Request::verifyPeer(false);
    $response = \Unirest\Request::put($url, $headers);
    return $response;
}

function callIuguConsultaBoleto($id)
{
    $url = "https://api.iugu.com/v1/invoices/" . $id . "?api_token=" . \Geral::getApiTokenIUGU();
    $headers = array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    );
    \Unirest\Request::verifyPeer(false);
    $response = \Unirest\Request::get($url, $headers);
    return $response;
}

function loadDadosChargeIugu(Cliente $cliente, Municipio $municipio, $operacao, $numDiasVcto, $valor, $descricao, $dataMvto)
{
    $modelCharger = new \models\IuguChargeModel();
    $modelCharger->setMethod("bank_slip");
    $modelCharger->setRestrictPaymentMethod(true);
    $modelCharger->setEmail("iugu@gerboletos.com.br");
    $modelCharger->setMonths(null);
    $modelCharger->setNotes('Notas');
    $modelCharger->setDiscountCents(0);
    $modelCharger->setBankSlipExtraDays($numDiasVcto);
    $modelCharger->setKeepDunning(false);
    $modelCharger->setOrderId($operacao);

    $payerCliente = loadPayerByCliente($cliente, $municipio);
    $modelCharger->setPayer($payerCliente);

    $items[] = new \models\IuguItemsChargeModel();
    $items[0]->setDescription($descricao);
    $items[0]->setQuantity(1);
    $items[0]->setPriceCents(round($valor * 100));
    $modelCharger->setItems($items);
    return $modelCharger;
}


function getDadosPhone(Cliente $cliente, IuguPayerModel $payer)
{
    if ($cliente->getCelular() != null && sizeof($cliente->getCelular()) >= 10) {
        $payer->setPhonePrefix(substr($cliente->getCelular(), 1, 2));
        $payer->setPhone(substr($cliente->getCelular(), 3));
    } else {
        if ($cliente->getFone() != null && sizeof($cliente->getFone()) >= 10) {
            $payer->setPhonePrefix(substr($cliente->getFone(), 1, 2));
            $payer->setPhone(substr($cliente->getFone(), 3));
        }
    }
}

function loadPayerByCliente(Cliente $cliente, Municipio $municipio)
{

    $Email = "iugu@gerboletos.com.br";
    $ufMunicipio = "PR";

    $nomeMunicipio = $cliente->getMuniCodigo();
    if ($municipio != null) {
        if ($municipio->getNome() != null && trim($municipio->getNome()) != "") {
            $nomeMunicipio = $municipio->getNome();
        }
        if ($municipio->getUf() != null && trim($municipio->getUf()) != "") {
            $ufMunicipio = $municipio->getUf();
        }
    }

    $payer = new \models\IuguPayerModel();
    $payer->setCpfCnpj($cliente->getCnpjCpf());
    $payer->setName($cliente->getNome());
    $payer->setEmail($Email);
    getDadosPhone($cliente, $payer);
    $payer->setAddress(new \models\IuguAddressModel());
    $payer->getAddress()->setStreet($cliente->getEndereco());
    $payer->getAddress()->setNumber($cliente->getEnderecoNumero());
    $payer->getAddress()->setDistrict($cliente->getEnderecoBairro());
    $payer->getAddress()->setZipcode($cliente->getCep());
    $payer->getAddress()->setComplement($cliente->getEnderecoComplemento());
    $payer->getAddress()->setCity($nomeMunicipio);
    $payer->getAddress()->setState($ufMunicipio);
    return $payer;
}


function convertKeyIugoToUserText($valueKey)
{
    if ($valueKey != null && trim($valueKey) != "") {
        $valueKey = strtolower(trim($valueKey));
        if ($valueKey == "payer.address.zip_code") {
            return " CEP da Entidade Pagadora: ";
        } else if ($valueKey == "payer.cpf_cnpj") {
            return " CNPJ/CPF da Entidade Pagadora: ";
        } else if ($valueKey == "payer.cpf_cnpj - is invalid" || $valueKey == "payer.cpf_cnpj - não é válido") {
            return " CNPJ/CPF Inválido";
        }
    }
    return "";
}


function executeBaixaBltIugu($idCancelamento)
{
    if ($idCancelamento != null && $idCancelamento != "") {
        $response = callIuguCancelamentoBlt($idCancelamento);
        $resultprocess = validaResponseBoletoCallCancell($idCancelamento, $response);
        if ($resultprocess == null) {
            return null;
        } else {
            $response = callIuguConsultaBoleto($idCancelamento);
            if ($response->code == 200 && $response->body != null && $response->body->errors == null) {
                include_once("IuguProcessaStatus.php");
                $fatura = getObjectFaturaIugu(array($response->body)[0]);
                if ($fatura!=null) {
                    if (strtoupper($fatura->status)=="EXPIRED"){
                       return null;
                    } else {
                        $status = getStatusByFatura($fatura);
                        if ($status == "C") {
                            return null;
                        }
                    }
                }
            }
            return $resultprocess;
        }
    } else {
        return "Código Identificador na Iugu Não localizado,";
    }
}