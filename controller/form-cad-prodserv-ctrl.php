<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 16/08/17
 * Time: 13:27
 */

require_once("../vendor/autoload.php");
include_once '../database.php';
include_once "../phputils.php";
INCLUDE_once("UserCtrl.php");

// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\ProdServ;


// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\ProdServ";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-cad-prodser.php";


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
                    $entity = $entityManager->find($entityName, $primariKey);
                    if ($entity != null) {
                        $entityManager->remove($entity);
                        $entityManager->flush();
                        $result = "success";
                    } else {
                        $result = "Entidade Não Localizada";
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
                    $entidade = new ProdServ();
                    $entidade->setCodigo(0);
                } else {
                    $entidade = $entityManager->find($entityName, $_POST['codigo']);
                }
                if ($entidade != null) {
                    $entidade->setDescricao($_POST['edDescricao']);
                    $entidade->setValor(strToFloat($_POST['edValor']));
                    if ($isInsert) {
                        $usuario = ctrl\UserCtrl::getObjetoUsuario_Login();
                        $entidade->setEmpresa($usuario->getEmpresa());
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
}


// #####################################################
// ##[alteracao]
// ##                    Validate
// ##
// #####################################################
function validaDadosInsertUpdate(ProdServ $prodser, $isInsert)
{
    $msgDefault = "Validação de Dados: ";
    if ($prodser == null) {
        return $msgDefault . "Dados do Produto/Serviço Inválidos, Null";
    }
    if ($prodser->getDescricao() == null || $prodser->getDescricao() == "") {
        return $msgDefault . "Descrição inválida";
    }
    if ($prodser->getEmpresa() == null || $prodser->getEmpresa() == "") {
        return $msgDefault . "Empresa inválida";
    }
    if ($prodser->getValor()==null || $prodser->getValor() <= 0) {
        return $msgDefault . "Valor Inválido";
    }
    return null;
}

