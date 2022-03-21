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
use models\Municipio;


// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\Municipio";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-cad-municipios.php";


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
                    $entidade = new Municipio();
                    $entidade->setCodigo(0);
                } else {
                    $entidade = $entityManager->find($entityName, $_POST['codigo']);
                }
                if ($entidade != null) {
                    $entidade->setNome($_POST['edNome']);
                    $entidade->setUf($_POST['edUF']);
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
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // #####################################################
    // ##
    // ##         IF Method Request Is "GET"
    // ##
    // #####################################################
    $erro = null;
    try {
        $nome = $_GET['nome'];
        $uf = $_GET['uf'];
        if ($nome != null && $uf != null && $nome != "" && $uf != "") {
            if ($entityManager != null) {
                $entity = $entityManager->createQuery('SELECT u FROM ' . $entityName . ' u WHERE u.nome= :nome and u.uf= :uf');
                $entity->setParameter('nome',$nome);
                $entity->setParameter('uf',$uf);
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


// #####################################################
// ##[alteracao]
// ##                    Validate
// ##
// #####################################################
function validaDadosInsertUpdate(Municipio $Municipios, $isInsert)
{
    $msgDefault = "Validação de Dados: ";
    if ($Municipios == null) {
        return $msgDefault . "Dados do Município Inválidos, Null";
    }
    if ($Municipios->getNome() == null || $Municipios->getNome() == "") {
        return $msgDefault . "Nome inválido";
    }
    if ($Municipios->getUf() == null || $Municipios->getUf() == "") {
        return $msgDefault . "UF inválida";
    }
    if (!$isInsert && $Municipios->getCodigo() <= 0) {
        return $msgDefault . "Código Inválido";
    }
    return null;
}

