<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 16/08/17
 * Time: 13:27
 */

require_once("../vendor/autoload.php");
include_once '../database.php';
include_once('../Utils/UtilsFunc.php');



// #####################################################
// ##[Alterações]
// ##         Definição dos NamesSpaces
// #####################################################
use models\Usuarios;


// #####################################################
// ##[Alterações]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\Usuarios";
$fieldNameInModal = "codigo";
$locationRedirAfter_Insert_Update = "./form-cad-usuarios.php";


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
                    $entidade = new Usuarios();
                    $entidade->setCodigo(0);
                } else {
                    $entidade = $entityManager->find($entityName, $_POST['codigo']);
                }
                if ($entidade != null) {
                    $entidade->setNome($_POST['edNome']);
                    $entidade->setEmail($_POST['edEmail']);
                    $entidade->setCpf( $_POST['edCpf']);
                    //$entidade->setGrupo($_POST['edGrupo']);
                    //$entidade->setEmpresa($_POST['edEmpresa']);
                    $entidade->setGrupo(1);
                    $entidade->setEmpresa(1);
                    if ($isInsert) {    // [Alterações] Campo Gravado Apeans no Insert Data de Cadastro
                        $entidade->setAdministrador('N');
                        $entidade->setAtivo('N');
                        $entidade->setDatacadastro(new DateTime('now'));
                        // $entityGrupo = $entityManager->find("models\Grupos", $entidade->setGrupo(1));
                        // if ($entityGrupo != null) {
                        //     if ($entityGrupo->getAcessos()!=""){
                        //         $entidade->setAcessos($entityGrupo->getAcessos());
                        //     }
                        // }
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
    // ##            Update Field: Ativo
    // ##
    // #####################################################
    if ($_POST['action'] == 'updateAtivo') {
        $result = "Erro Desconhecido";
        try {
            if ($entityManager != null) {
                $entidade = null;
                $entidade = $entityManager->find($entityName, $_POST['primarikey']);
                if ($entidade != null) {
                    if ($entidade->getAtivo() == 'S') {
                        $entidade->setAtivo('N');
                    } else {
                        $entidade->setAtivo('S');
                    }
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
    // ##            Update Field: Acessos
    // ##
    // #####################################################
    if ($_POST['action'] == 'updateAcessos') {
        $result = "Erro Desconhecido";
        try {
            if ($entityManager != null) {
                $entidade = null;
                $entidade = $entityManager->find($entityName, $_POST['primarikey']);
                if ($entidade != null) {
                    $entidade->setAcessos($_POST['acessos']);
                    $entityManager->merge($entidade);
                    $entityManager->flush();
                    $result = "success";
                } else {
                    $result = "Erro dados da Entidade Não Localizados";
                }
            } else {
                $result = "Erro ao Utilizar o Controlador de Entidades, Null";
            }
        } catch
        (Exception $exception) {
            $result = "Exception: " . $exception->getMessage();
        }
        echo $result;
    }

    // #####################################################
    // ##
    // ##            Update Field: Senha
    // ##
    // #####################################################
    if ($_POST['action'] == 'updatePassword') {
        $result = "Erro Desconhecido";
        try {
            $PWValid = false;
            $pw1 = $_POST['pw1'];
            $pw2 = $_POST['pw2'];
            if ($pw1 != null && $pw2 != null) {
                if (trim($pw1) != "") {
                    if (trim($pw1) == trim($pw2)) {
                        $PWValid = true;
                    } else {
                        $result = "Senhas Não conincidem, Verifique";
                    }
                } else {
                    $result = "Obrigatório o Preenchimento de Todos os Campos";
                }
            } else {
                $result = "Senhas Inválidas - Dados Nulos";
            }
            if ($PWValid) {
                $passwordMD5Value = md5(trim($pw1));
                if ($entityManager != null) {
                    $entidade = null;
                    $entidade = $entityManager->find($entityName, $_POST['primarikey']);
                    if ($entidade != null) {
                        $entidade->setSenha($passwordMD5Value);
                        $entityManager->merge($entidade);
                        $entityManager->flush();
                        $result = "success";
                    } else {
                        $result = "Erro dados da Entidade Não Localizados";
                    }
                } else {
                    $result = "Erro ao Utilizar o Controlador de Entidades, Null";
                }
            }
        } catch
        (Exception $exception) {
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
// ##
// ##                    Validate
// ##
// #####################################################
function validaDadosInsertUpdate(Usuarios $usuario, $isInsert)
{
    $msgDefault = "Validação de Dados: ";
    if ($usuario == null) {
        return $msgDefault . "Dados da Entidade Inválidos, Null";
    }
    if ($usuario->getNome() == null || $usuario->getNome() == "") {
        return $msgDefault . "Nome inválido";
    }
    if ($usuario->getDatacadastro() == null) {
        return $msgDefault . "Data de Cadastro inválida";
    }
    if ($usuario->getEmail() == null || $usuario->getEmail() == "") {
        return $msgDefault . "E-Mail inválido";
    }
    if ($usuario->getCpf() == null || $usuario->getCpf() == "") {
        return $msgDefault . "CPF inválido";
    }
    if (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL)) {
        return $msgDefault . "E-Mail inválido";
    }
    if (!$isInsert && $usuario->getCodigo() <= 0) {
        return $msgDefault . "Código Inválido";
    }
    return null;
}

