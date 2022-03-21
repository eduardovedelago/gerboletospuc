<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 16/08/17
 * Time: 13:27
 */

require_once("../vendor/autoload.php");
INCLUDE_once("./UserCtrl.php");
include_once '../database.php';
include_once "../phputils.php";
include_once("../src/models/Register.php");


// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\Register;

// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\Register";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./login.php";


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



    // #####################################################
    // ##
    // ##               INSERT /or UPDATE
    // ##
    // #####################################################


    if ($_POST['action'] == 'insert') {
        $result = "Erro Desconhecido";
        try {
            if ($entityManager != null) {
                $reg = new Register();
                $reg->setCodigo(0);
                $reg->setNomeempresa($_POST['edNomeempresa']);
                $reg->setRazaosocial($_POST['edRazaosocial']);
                $reg->setCnpj($_POST['edCnpj']);
                $reg->setEmail($_POST['edEmail']);
                
                $reg->setNome($_POST['edNome'].' '.$_POST['edSobrenome']);
                $reg->setFone($_POST['edFone']);
                $reg->setFone2($_POST['edFone2']);
                $reg->setSexo($_POST['edSexo']);
                $reg->setOrigeminteresse($_POST['edOrigeminteresse']);
                $reg->setObs($_POST['edObs']);

                $reg->setStatus("P");
                $reg->setDataInclusao(new DateTime('now'));
                $resultValidacao = validaDadosInsert($reg);
                if ($resultValidacao == null) {
                    $entityManager->persist($reg);
                }
                if ($resultValidacao == null) {
                    $entityManager->flush();
                    $result = "success";
                } else {
                    $result = $resultValidacao;
                }
            } else {
                $resultValidacao = "Erro ao Utilizar o Controlador de Entidades, Null";
            }
        } catch (Exception $exception) {
            $result = "Exception: " . $exception->getMessage();
        }
        echo $result;
    }
}


// #####################################################
// ##
// ##               Funções
// ##
// #####################################################


// #####################################################
// ##[alteracao]
// ##                    Validate
// ##
// #####################################################
function validaDadosInsert(Register $reg)
{
    $msgDefault = null;
    if ($reg == null) {
        return $msgDefault . "<br> Dados Inválidos, Null";
    }
    if ($reg->getStatus() == null || ($reg->getStatus() != "P" && $reg->getStatus() != "B")) {
        return $msgDefault . "<br> Status inválido";
    }
    if ($reg->getEmail()==null || $reg->getEmail()=="") {
        return $msgDefault . "<br> Email Inválido";
    }
    if ($reg->getNome()==null || $reg->getNome()=="") {
        return $msgDefault . "<br> Nome/Sobrenome Inválido";
    }
    if ($reg->getNomeempresa()==null || $reg->getNomeempresa()=="") {
        return $msgDefault . "<br> Nome Empresa Inválido";
    }
    if ($msgDefault != null) {
        $msgDefault = "Validação de Dados: " . $msgDefault;
        return $msgDefault;
    }
    return null;
}
