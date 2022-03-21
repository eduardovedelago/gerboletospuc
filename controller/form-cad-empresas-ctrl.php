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
use models\Empresa;

// #####################################################
// ##[alteracao]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\Empresa";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-cad-empresas.php";


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
                    $entidade = new Empresa();
                    $entidade->setCodigo(0);
                } else {
                    $entidade = $entityManager->find($entityName, $_POST['codigo']);
                }
                if ($entidade != null) {
                    $entidade->setNome($_POST['edNome']);
                    $entidade->setRazaosocial($_POST['edRazaosocial']);
                    $entidade->setCnpj($_POST['edCnpj']);
                    $entidade->setEmail($_POST['edEmail']);
                    $entidade->setMunicipio($_POST['edMunicipio']);
                    $entidade->setEndereco($_POST['edEndereco']);
                    $entidade->setEndereconumero($_POST['edEndereconumero']);
                    $entidade->setEnderecocompl($_POST['edEnderecocompl']);
                    if ($isInsert) {// [Alterações] Campo Gravado Apeans no Insert Data de Cadastro
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
    // ##            Update Field: Config
    // ##
    // #####################################################
    if ($_POST['action'] == 'updateConfig') {
        $result = "Erro Desconhecido";
        try {
            if ($entityManager != null) {
                $entidade = null;
                $entidade = $entityManager->find($entityName, $_POST['primarikey']);
                if ($entidade != null) {
                    $entidade->setCarteiragarantida($_POST['edCarteiragarantida']);
                    $entidade->setClireparcelar($_POST['edClireparcelar']);
                    $entidade->setClinumparcelas($_POST["edClieNumParcelas"]);
                    $entidade->setCliparcvalorminimo($_POST["edCliparcvalorminimo"]);
                    $entidade->setTaxaboleto($_POST['edTaxaboleto']);
                    $entidade->setTaxacheque($_POST['edTaxacheque']);
                    $entidade->setJurosboleto($_POST['edJurosboleto']);
                    $entidade->setMultaboleto($_POST['edMultaboleto']);
                    $entidade->setMoraboleto($_POST['edMoraboleto']);
                    $entidade->setDataContrato(new DateTime($_POST['edDataContrato']));
                    //Antecipação
                    $entidade->setFatorCompra($_POST['edFatorCompra']);
                    $entidade->setPercIOFDiario($_POST['edPercIOFDiario']);
                    $entidade->setPercIOF($_POST['edPercIOF']);
                    $entidade->setPercAdValoren($_POST['edPercadValoren']);
                    $entityManager->merge($entidade);
                    $entityManager->flush();
                    $result = "success";
                } else {
                    $result = "Erro dados da Entidade Não Localizados";
                }
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
function validaDadosInsertUpdate(Empresa $empresa, $isInsert)
{
    $msgDefault = "Validação de Dados: ";
    if ($empresa == null) {
        return $msgDefault . "Dados do Município Inválidos, Null";
    }
    if ($empresa->getNome() == null || $empresa->getNome() == "") {
        return $msgDefault . "Nome inválido";
    }
    if ($empresa->getRazaosocial() == null || $empresa->getRazaosocial() == "") {
        return $msgDefault . "Razão Social inválido";
    }
    if ($empresa->getCnpj() == null || $empresa->getCnpj() == "") {
        return $msgDefault . "CNPJ inválido";
    }
    if ($empresa->getEndereco() == null || $empresa->getEndereco() == "") {
        return $msgDefault . "Endereço inválido";
    }
    if (!$isInsert && $empresa->getCodigo() <= 0) {
        return $msgDefault . "Código Inválido";
    }
    return null;
}

