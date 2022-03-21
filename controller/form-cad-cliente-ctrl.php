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
include_once ('../src/models/PendFin.php');

// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\Cliente;
use models\PendFin;

// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\Cliente";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-cad-cliente.php";


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
        $result = "";
        try {
            $primariKey = $_POST['primarikey'];
            if ($primariKey > 0) {
                if ($entityManager != null) {
                    $countPF = sizeof($entityManager->createQuery('SELECT u FROM models\PendFin u WHERE u.codEntidade='.$primariKey)->getArrayResult());
                    if (($countPF == null) || ($countPF == 0)) {
                        $entity = $entityManager->find($entityName, $primariKey);
                        if ($entity != null) {
                            $entityManager->remove($entity);
                            $entityManager->flush();
                            $result = "success";
                        } else {
                            $result = "Entidade Não Localizada";
                        }
                    } else {
                        $result = "Cliente possuí movimentos, exclusão não é possível.";
                    }
                } else {
                    $result = "Erro ao Utilizar o Controlador de Entidades, Null";
                }
            } else {
                $result = "Chave da Entidade Zerada";
            }
        } catch (Exception $exception) {
            $result = $exception->getMessage();
        }
        echo $result;
    }


    // #####################################################
    // ##
    // ##               INSERT /or UPDATE
    // ##
    // #####################################################

    if (($_POST['action'] == 'insert') || ($_POST['action'] == 'edit')) {
        $isInsert = ($_POST['action'] == 'insert');
        $result = "Erro Desconhecido";
        try {
            if ($entityManager != null) {

                // #####################################################    -   Begin;
                // ## [Alterações] - Mapeamento para campos do HTML
                // #####################################################

                $entidade = null;
                if ($isInsert) {
                    $entidade = new Cliente();
                    $entidade->setCodigo(0);
                } else {
                    $entidade = $entityManager->find($entityName, $_POST['codigo']);
                }
                if ($entidade != null) {
                    $entidade->setNome($_POST['edNome']);
                    $entidade->setRazaosocial($_POST['edRazaoSocial']);
                    $entidade->setCnpjCpf($_POST['edCnpjCpf']);
                    $entidade->setEmail($_POST['edEmail']);
                    $entidade->setMuniCodigo($_POST['edMunicipio']);
                    $entidade->setEndereco($_POST['edEndereco']);
                    $entidade->setEnderecoNumero($_POST['edEnderecoNumero']);
                    $entidade->setEnderecoComplemento($_POST['edEnderecoComplemento']);
                    $entidade->setEnderecoBairro($_POST['edEnderecoBairro']);
                    $entidade->setCelular($_POST['edCelular']);
                    $entidade->setFone($_POST['edFone']);
                    $entidade->setCep($_POST['edCEP']);
                    $entidade->setObservacao($_POST['edObservacao']);
                    $entidade->setTipo($_POST['edTipo']);
                    $entidade->setSituacao($_POST['edSituacao']);
                    $entidade->setRgIe($_POST['edRgIe']);
                    $entidade->setMuniCodigo($_POST['edMunicipio']);
                    if ($isInsert) {// [Alterações] Campo Gravado Apeans no Insert Data de Cadastro
                        $usuario = ctrl\UserCtrl::getObjetoUsuario_Login();
                        $entidade->setDataCad(new DateTime('now'));
                        $entidade->setEmprCodigo($usuario->getEmpresa());
                        $entidade->setUsuaCodigo($usuario->getCodigo());
                    }
                    $resultValidacao = validaDadosInsertUpdate($entidade, $isInsert);
                    if ($resultValidacao == null) {
                        if ($isInsert) {
                            $entityManager->persist($entidade);
                        } else {
                            $entityManager->merge($entidade);
                        }
                        $entityManager->flush();
                        $result = "success";
                    } else {
                        $result = $resultValidacao;
                    }
                }

                // #####################################################    -   End;
                // ## [Alterações] - Mapeamento para campos do HTML - ./FINAL
                // #####################################################
            } else {
                $result = "Erro ao Utilizar o Controlador de Entidades, Null";
            }
        } catch (Exception $exception) {
            $result = "Exception: " . $exception->getMessage();
        }
        echo $result;
    }

// #####################################################
// ##
// ##         Busca dados da Entidade Antes de Abrir
// ##         Tela Modal, ou Quando for necessário
// ##         Abrir Dados da Entidade em questão.
// ##         Retornado Via JSON
// ##
// #####################################################
    if ($_POST['action'] == 'findEntidade') {
        $erro = null;
        try {
            $primariKey = $_POST['primarikey'];
            if ($primariKey > 0) {
                if ($entityManager != null) {
                    $entity = $entityManager->createQuery('SELECT u FROM ' . $entityName . ' u WHERE u.' . $fieldNameInModal . '=' . $primariKey);
                    $entity = $entity->getArrayResult();
                    if ($entity != null) {
                        echo json_encode($entity[0]);
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
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET['action'] == 'findEntidade') {
        $erro = null;
        try {
            $primariKey = $_GET['primarikey'];
            if ($primariKey > 0) {
                if ($entityManager != null) {
                    $entity = $entityManager->createQuery('SELECT u FROM ' . $entityName . ' u WHERE u.' . $fieldNameInModal . '=' . $primariKey);
                    $entity = $entity->getArrayResult();
                    if ($entity != null) {
                        echo json_encode($entity[0]);
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
}

// #####################################################
// ##[alteracao]
// ##                    Validate
// ##
// #####################################################
function validaDadosInsertUpdate(Cliente $cliente, $isInsert)
{
    $msgDefault = "Validação de Dados: ";
    if ($cliente == null) {
        return $msgDefault . "Dados do Município Inválidos, Null";
    }
    if ($cliente->getNome() == null || $cliente->getNome() == "") {
        return $msgDefault . "Nome inválido";
    }
    if ($cliente->getTipo() == null || $cliente->getTipo() == "") {
        return $msgDefault . "Tipo do Cliente inválido";
    }
    if ($cliente->getEmail() == null || $cliente->getEmail() == "") {
        return $msgDefault . "E-Mail inválido";
    }
    if (sizeof($cliente->getCnpjCpf())==19 && ($cliente->getRazaosocial() == null || $cliente->getRazaosocial() == "")) {
        return $msgDefault . "Razão Social inválido";
    }
    if ($cliente->getCnpjCpf() == null || $cliente->getCnpjCpf() == "") {
        return $msgDefault . "CNPJ/CPF inválido";
    }
    if ($cliente->getCep() == null || $cliente->getCep() == "") {
        return $msgDefault . "CEP inválido";
    }
    if ($cliente->getMuniCodigo() == null || $cliente->getMuniCodigo() <=0) {
        return $msgDefault . "Município inválido";
    }
    if ($cliente->getEnderecoBairro() == null || $cliente->getEnderecoBairro() == "") {
        return $msgDefault . "Bairro do Endereço inválido";
    }
    if ($cliente->getEnderecoNumero() == null || $cliente->getEnderecoNumero() == "") {
        return $msgDefault . "Número do Endereço inválido";
    }
    if ($cliente->getEndereco() == null || $cliente->getEndereco() == "") {
        return $msgDefault . "Endereço inválido";
    }
    if (!$isInsert && $cliente->getCodigo() <= 0) {
        return $msgDefault . "Código Inválido";
    }
    return null;
}

