<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 05/09/17
 * Time: 22:14
 */

require_once("../vendor/autoload.php");
include_once '../database.php';

// #####################################################
// ##[Alterações]
// ##         Definição dos NamesSpaces
// #####################################################
use models\Usuarios;
use models\Empresa;


// #####################################################
// ##[Alterações]
// ##         Váriaveis devem ser ajustadas
// ##
// #####################################################
$entityName = "models\Usuarios";
$locationRedirAfter_Insert_Update = "./login.php";


// #####################################################
// ##
// ##         IF Method Request Is "POST"
// ##
// #####################################################
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// #####################################################
// ##
// ##         Busca dados da Entidade Antes de Abrir
// ##         Tela Modal, ou Quando for necessário
// ##         Abrir Dados da Entidade em questão.
// ##         Retornado Via JSON
// ##
// #####################################################
    if ($_POST['action'] == 'executeLogin') {
        $erro = null;
        try {
            $cpf = $_POST['cpf'];
            $password = $_POST['password'];
            $remember = $_POST['remember'];
            $erro = validaDadosLogin($cpf, $password);
            if ($erro == null) {
                if ($entityManager != null) {
                    $entity = $entityManager->createQuery('SELECT u FROM ' . $entityName . ' u WHERE u.cpf=\'' . $cpf . '\'');
                    $entity = $entity->getSingleResult();
                    if ($entity != null) {
                        if ($entity->getAtivo() == "S") {
                            if ($entity->getSenha() != null) {
                                $passwordMD5 = md5($password);
                                if ($entity->getSenha() == $passwordMD5) {
                                    if ($remember == "on") {
                                        setcookie('_cpf', $cpf, 0, "/");
                                        setcookie('_name', $entity->getNome(), 0, "/");
                                    } else {
                                        setcookie('cpf', 0, "/");
                                        setcookie('_name', 0, "/");
                                    }
                                    @session_start();
                                    $_SESSION['_sessionAuthenticated'] = "Authenticated";
                                    $_SESSION['_usuario'] = serialize($entity);
                                    setEmpresaSessao($entityManager,$entity->getEmpresa());
                                    //header('Location: /index.php');
                                } else {
                                    $erro = "Usuário ou Senha Inválidos";
                                }
                            } else {
                                $erro = "Usuário ou Senha Não Cadastrados";
                            }
                        } else {
                            $erro = "Usuário Inativo Verifique com Administrador e Tente Novamente";
                        }
                    } else {
                        $erro = "Dados do Usuário não localizados";
                    }
                } else {
                    $erro = "Erro ao Utilizar o Controlador de Entidades, Null";
                }
            }
        } catch (\Doctrine\ORM\NoResultException $e) {
            $erro = "Dados do Usuário não localizados";
        } catch (Exception $exception) {
            $erro = "Falha ao Efetuar Login, Exception: <br>" . $exception->getMessage();
        }
        if ($erro != null) {
            echo $erro;
        }
    }
}


function setEmpresaSessao($entityManager, $empresaUsuario)
{
    if ($entityManager != null && $empresaUsuario>0) {
        try {
            $empresa = $entityManager->find("models\Empresa", $empresaUsuario);
            if ($empresa!=null) {
                $_SESSION['_empresa'] = serialize($empresa);
            }
        } catch (\Doctrine\ORM\NoResultException $e) {
            $erro = "Dados do Usuário não localizados";
        } catch (Exception $exception) {
            $erro = "Falha ao Efetuar Login, Exception: <br>" . $exception->getMessage();
        }
    }
}


function validaDadosLogin($cpf, $password)
{
    if ($cpf == null || $cpf == "") {
        return "CPF Inválido, Campo Obrigatório";
    }
    if ($password == null || $password == "") {
        return "Senha Inválida, Campo Obrigatório";
    }
    return null;
}
