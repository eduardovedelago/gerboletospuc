<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 16/08/17
 * Time: 13:27
 */

require_once("../vendor/autoload.php");
include_once '../database.php';

// #####################################################
// ####[alteracao]
// ##         Definição dos NamesSpaces
// #####################################################
use models\Portador;


// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\Portador";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-cad-portador.php";


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
                    $entidade = new Portador();
                    $entidade->setCodigo(0);
                } else {
                    $entidade = $entityManager->find($entityName, $_POST['codigo']);
                }
                if ($entidade != null) {
                    $entidade->setDescricao($_POST['edDescricao']);
                    $entidade->setComportamento($_POST['edComportamento']);
                    if ($isInsert) {    // [Alterações] Campo Gravado Apeans no Insert Data de Cadastro
                        //
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
function validaDadosInsertUpdate(Portador $portador, $isInsert)
{
    $msgDefault = "Validação de Dados: ";
    if ($portador == null) {
        return $msgDefault . "Dados do Portador Inválidos, Null";
    }
    if ($portador->getDescricao() == null || $portador->getDescricao() == "") {
        return $msgDefault . "Descrição inválido";
    }
    return null;
}

